<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');


class LawsuitsController extends AppController {

    public $name = 'Lawsuits';
    
    public $uses = array('Lawsuit','Client');
    
    
    public function admin_add(){
        if(!empty($this->data)){
            if($this->Lawsuit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case opened successfully.') . '</div>');
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
    
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Lawsuit->id = $id;
        
        if(!empty($this->data)){
            if($this->Lawsuit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
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
        
        $this->set(compact('clients'));

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Lawsuit.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Lawsuit"]["order"]="Lawsuit.created DESC";
        
        $items = $this->paginate('Lawsuit', $options);
        
        
        //pr($items);
        $this->set(compact('items','search'));
        
        
        //$this->set("search",$search);
    }
    
    
    
    public function test(){
        throw new BadRequestException();
    }
            
    
    function admin_remove_image($name) {
        $this->Lawsuit->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/items/original/".$name);
        @unlink(WWW_ROOT."img/items/resize/".$name);
        @unlink(WWW_ROOT."img/items/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }
}
