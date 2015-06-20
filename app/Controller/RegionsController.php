<?php

App::uses('AppController', 'Controller');


class RegionsController extends AppController {

    public $name = 'Regions';

    public function admin_add(){
        if(!empty($this->data)){
            if($this->Region->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Region added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'regions', 'action' => 'edit', $this->Region->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Region now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Region->id = $id;
        if(!empty($this->data)){
            if($this->Region->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Region updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'regions', 'action' => 'edit', $this->Region->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Region now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'regions', 'action' => 'edit', $this->Region->id));
            }
        }

        $this->data = $this->Region->read();

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Region.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Region"]["order"]="Region.created DESC";
        
        $designations = $this->paginate('Region', $options);
        //pr($categories);
        $this->set(compact('designations','search'));
        
        
        //$this->set("search",$search);
    }

}
