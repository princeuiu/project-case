<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');


class LawsuitsController extends AppController {

    public $name = 'Lawsuits';

    public $uses = array('Lawsuit','Client', 'History', 'Task','Activity');


    public function add(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            $tempo = $this->data;
            $tempo['Lawsuit']['created_by'] = Authsome::get("name");
//            print_r($tempo);die;
            if($this->Lawsuit->save($tempo)){
////                $this->Lawsuit->saveField('created_by', Authsome::get("name"));
//                $this->Lawsuit->saveField('created_by', 'asdddds');
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case opened successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("lawsuit","new",$this->Lawsuit->id,Authsome::get("id"),0,'');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t open Case now, Please try again later.') . '</div>');
                return;
            }
        }

        $clients = $this->Client->find('list', array(
            'conditions' => array('Client.status' => 'active')
        ));

        $this->set(compact('clients'));
    }


    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));
        if($id == null){
            throw new BadRequestException();
        }
        $this->Lawsuit->id = $id;

        if(!empty($this->data)){
            if($this->Lawsuit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("lawsuit","update",$this->Lawsuit->id,Authsome::get("id"),0,'');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Case now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
        }

        $this->data = $this->Lawsuit->read();

        $clients = $this->Client->find('list', array(
            'conditions' => array('Client.status' => 'active')
        ));
        $case_id = $id;
        $this->set(compact('clients','case_id'));


        $this->render('edit');
    }

    public function details($id) {
        $this->check_access(array('employee', 'manager','admin'));
        if($id == null){
            throw new BadRequestException();
        }
        $this->Lawsuit->id = $id;

//        if(!empty($this->data)){
//            if($this->Lawsuit->save($this->data)){
//                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
//                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
//            }
//            else{
//                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Case now, Please try again later.') . '</div>');
//                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
//            }
//        }

        $this->data = $this->Lawsuit->read();

//        $clients = $this->Client->find('all', array(
//            'conditions' => array('Client.status' => 'active')
//        ));
        $histories = $this->History->find('all', array(
            'conditions' => array('History.lawsuit_id' => $id)
        ));
        $this_case = $this->Lawsuit->find('first', array(
            'conditions' => array('Lawsuit.id' => $id)
        ));
        $this_case_task = $this->Task->find('all', array(
            'conditions' => array('Task.lawsuit_id' => $id)
        ));
//        print_r($this_case_task); die;
//
        $this->set(compact('histories', 'this_case', 'this_case_task'));


        $this->render('detail');
    }

    public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
//        $options["Lawsuit.type"]="landvetting";
        if(isset($search)){
            $options["Lawsuit.title like"]="%$search%";
        }
        else $search="";

        $this->paginate["Lawsuit"]["order"]="Lawsuit.created DESC";
//        $this->paginate["Lawsuit"]["condition"]=array("Lawsuit.type" => "landvetting");
//        print_r($Lawsuit);die;
        $items = $this->paginate('Lawsuit', $options);


//        print_r($items); die;
        $caseType = "all";
        $this->set(compact('items','search', 'caseType'));


        //$this->set("search",$search);
    }

    public function landvetting() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
        $options["Lawsuit.type"]="landvetting";
        if(isset($search)){
            $options["Lawsuit.title like"]="%$search%";
        }
        else $search="";

        $this->paginate["Lawsuit"]["order"]="Lawsuit.created DESC";
//        $this->paginate["Lawsuit"]["condition"]=array("Lawsuit.type" => "landvetting");
//        print_r($Lawsuit);die;
        $items = $this->paginate('Lawsuit', $options);


        //pr($items);
        $caseType = "landvetting";
        $this->set(compact('items','search', 'caseType'));

        $this->render('index');
        //$this->set("search",$search);
    }

public function litigation() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
        $options["Lawsuit.type"]="litigation";
        if(isset($search)){
            $options["Lawsuit.title like"]="%$search%";
        }
        else $search="";

        $this->paginate["Lawsuit"]["order"]="Lawsuit.created DESC";
//        $this->paginate["Lawsuit"]["condition"]=array("Lawsuit.type" => "landvetting");
//        print_r($Lawsuit);die;
        $items = $this->paginate('Lawsuit', $options);


        //pr($items);
    $caseType = "litigation";
    $this->set(compact('items','search', 'caseType'));

        $this->render('index');
        //$this->set("search",$search);
    }



    public function test(){
        throw new BadRequestException();
    }


    function remove_image($name) {
        $this->Lawsuit->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/items/original/".$name);
        @unlink(WWW_ROOT."img/items/resize/".$name);
        @unlink(WWW_ROOT."img/items/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }
}
