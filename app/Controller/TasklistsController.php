<?php

App::uses('AppController', 'Controller');


class TasklistsController extends AppController {

    public $name = 'Tasklists';
    
    public $uses = array('Lawsuit', 'Task','Activity','Court','Tasklist');

    public function add(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            if($this->Tasklist->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Tasklist added successfully.') . '</div>');

                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));

            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Tasklist now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    
    public function addlit(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            $data = $this->data;
            unset($data['Tasklist']['court']);
            if($this->Tasklist->save($data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Tasklist added successfully.') . '</div>');

                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));

            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Tasklist now, Please try again later.') . '</div>');
                return;
            }
        }
        $courtsArray = $this->Court->children(1, true, array('id', 'name'));
        $courts = array();
        $count = 0;
        $selectedCourtId = 0;
        foreach($courtsArray as $eachItem){
            $courts[$eachItem['Court']['id']] = $eachItem['Court']['name'];
            if($count == 0){
                $selectedCourtId = $eachItem['Court']['id'];
            }
            $count++;
        }
        $categoriesArray = $this->Court->children($selectedCourtId, true, array('id', 'name'));
        $categories = array();
        foreach($categoriesArray as $eachItem){
            $categories[$eachItem['Court']['id']] = $eachItem['Court']['name'];
        }
        $this->set(compact('courts', 'categories'));
    }
    
    
    public function ajax_add(){
        //if(!empty($this->data))
        $temp = $_POST['data'];
        $data = array('Tasklist'=> $temp);
        if($this->Tasklist->save($data)){
//            $savedTasklist = array(
//                'id' => $this->Tasklist->id,
//                'name' => $temp['name']
//            );
            Echo '{"id":'.$this->Tasklist->id.',"name":"'.$temp['name'].'"}';
        }
        else{
            Echo false;
        }
        exit;
    }


    
    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->Tasklist->id = $id;
        if(!empty($this->data)){
            if($this->Tasklist->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Tasklist updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Tasklist now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'edit', $this->Tasklist->id));
            }
        }

        $this->data = $this->Tasklist->read();
        //print_r($this->data); die;

        
        $this->render('add');
    }
    
    
    public function editlit($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->Tasklist->id = $id;
        if(!empty($this->data)){
            if($this->Tasklist->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Tasklist updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Tasklist now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'editlit', $this->Tasklist->id));
            }
        }

        $this->data = $this->Tasklist->read();
        //print_r($this->data); die;
        
        $courtsArray = $this->Court->children(1, true, array('id', 'name'));
        $courts = array();
        $count = 0;
        $selectedCourtId = 0;
        foreach($courtsArray as $eachItem){
            $courts[$eachItem['Court']['id']] = $eachItem['Court']['name'];
            if($count == 0){
                $selectedCourtId = $eachItem['Court']['id'];
            }
            $count++;
        }
        $categoriesArray = $this->Court->children($selectedCourtId, true, array('id', 'name'));
        $categories = array();
        foreach($categoriesArray as $eachItem){
            $categories[$eachItem['Court']['id']] = $eachItem['Court']['name'];
        }
        $this->set(compact('courts', 'categories'));

        
        $this->render('addlit');
    }
    
    public function index() {
        
        $this->check_access(array('employee', 'manager','admin'));

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Tasklist.created DESC'
        );
        
        
        $items = $this->Paginator->paginate('Tasklist');
        //print_r($items); die;
        $this->set(compact('items'));
        
        
        //$this->set("search",$search);
    }
    
    
    public function delete($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->check_access(array('manager','admin'));
        
        $hasTask = $this->Task->find('count', array(
            'conditions' => array('Task.tasklist_id' => $id)
        ));
        
        if($hasTask < 1){
            if($this->Tasklist->delete($id)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Tasklist item deleted successfully.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t delete Tasklist item now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));
            }
        }
        else{
            $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('You can\'t delete a Tasklist item that have Task under it.') . '</div>');
            return $this->redirect(array('controller' => 'tasklists', 'action' => 'index'));
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
