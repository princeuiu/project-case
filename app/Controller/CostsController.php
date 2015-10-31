<?php

App::uses('AppController', 'Controller');


class CostsController extends AppController {

    public $name = 'Costs';

    public function add(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            if($this->Cost->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Cost added successfully.') . '</div>');

                return $this->redirect(array('controller' => 'costs', 'action' => 'index'));

            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Cost now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    
    public function edit($id) {
        $this->check_access(array('manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->Cost->id = $id;
        if(!empty($this->data)){
            if($this->Cost->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Cost updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'costs', 'action' => 'edit', $this->Cost->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Cost now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'costs', 'action' => 'edit', $this->Cost->id));
            }
        }

        $this->data = $this->Cost->read();
        //print_r($this->data); die;

        
        $this->render('add');
    }
    
    public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Cost.name like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Cost"]["order"]="Cost.created DESC";
        
        $costs = $this->paginate('Cost', $options);
        //pr($categories);
        $this->set(compact('costs','search'));
        
        
        //$this->set("search",$search);
    }
    
    
    public function ajax_getcostlists(){
        
        $costListArr = $this->Cost->find('all', array(
            'conditions' => array('Cost.status' => 'active'),
            'recursive' => -1,
            'fields' => array('Cost.id','Cost.name')
        ));
        $costListing = array();
        foreach($costListArr as $eachCost){
            $costListing[] = array(
                'id' => $eachCost['Cost']['id'],
                'name' => $eachCost['Cost']['name']
            );
        }
        Echo json_encode($costListing);
        //print_r($lawsuitsList);
        exit;
    }
    
    public function delete($id) {
        if($id == null){
            throw new BadRequestException();
        }
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
