<?php

App::uses('AppController', 'Controller');


class HistoriesController extends AppController {

    public $name = 'Histories';

    public $uses = array('History', 'Lawsuit', 'Client');

    /**
     *
     */
    public function add(){
        $this->check_access(array('employee', 'manager','admin'));

        if(!empty($this->data)){
//            $lawsuit_id = $this->data['History']['lawsuit_id'];
//            $title = $this->data['History']['title'];
//            $description = $this->data['History']['description'];
//            $reporting_date = $this->data['History']['reporting_date'];
//            $remark = $this->data['History']['remark'];

            if($this->History->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return;
            }
        }
        $options = array(
            'NOT' => array(
                'parent_id' => null,
            ),
        );
        $lawsuits = $this->Lawsuit->find('list', array(
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
            'conditions' => array('Lawsuit.status'=>'active')
        ));
//        pr($lawsuits);

        $this->set(compact('lawsuits'));
    }


    public function calender(){
        $this->check_access(array('employee', 'manager','admin'));

        $histories = $this->History->find('all', array(
            'fields' => array('History.reporting_date', 'History.title', 'History.id'),
            'conditions' => array('History.status'=>'pending')
        ));
        //print_r($histories); die;
        $this->set(compact('histories'));
    }

    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->History->id = $id;
        if(!empty($this->data)){
            if($this->History->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
        }
        $this->set(compact('lawsuits'));
        $this->data = $this->History->read();
        $lawsuits = $this->Lawsuit->find('list', array(
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
            'conditions' => array('Lawsuit.number'=>$this->data['Lawsuit']['number'])
        ));
        $this->set(compact('lawsuits'));
        $this->render('edit');
    }


    public function view($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $historyData = $this->History->find('first',array(
            'conditions' => array('History.id' => $id)
        ));
        $clientId = $historyData['Lawsuit']['client_id'];
        $lawsuitNumber = $historyData['Lawsuit']['number'];
        $clientInfo = $this->Client->find('first',array(
            'conditions' => array('Client.id' => $clientId),
            'recursive' => -1
        ));
        $this->set(compact('historyData','clientInfo', 'lawsuitNumber', 'id'));
        $this->render('view');
    }


    public function timeline($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $timelineData = $this->History->find('all',array(
            'conditions' => array('History.lawsuit_id' => $id),
            'order' => array('History.reporting_date DESC')
        ));
//        print_r($timelineData);die;
        $this->set(compact('timelineData'));
        $this->render('timeline');
    }


    public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
        $options = array(
            'NOT' => array(
                'parent_id' => 0,
            ),
        );
        if(isset($search)){
            $options["Category.title like"]="%$search%";
        }
        else $search="";

        $this->paginate["Category"]["order"]="Category.created DESC";

        $categories = $this->paginate('Category', $options);
        //pr($categories);
        $this->set(compact('categories','search'));


        //$this->set("search",$search);
    }



    function remove_image($name) {
        $this->Category->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/categories/original/".$name);
        @unlink(WWW_ROOT."img/categories/resize/".$name);
        @unlink(WWW_ROOT."img/categories/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }

}
