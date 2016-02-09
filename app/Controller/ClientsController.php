<?php

App::uses('AppController', 'Controller');


class ClientsController extends AppController {

    public $name = 'Clients';

    public function add(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            if($this->Client->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Client added successfully.') . '</div>');

                return $this->redirect(array('controller' => 'clients', 'action' => 'index'));

            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Client now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    
    public function ajax_add(){
        //if(!empty($this->data))
        $temp = $_POST['data'];
        $data = array('Client'=> $temp);
        if($this->Client->save($data)){
//            $savedClient = array(
//                'id' => $this->Client->id,
//                'name' => $temp['name']
//            );
            Echo '{"id":'.$this->Client->id.',"name":"'.$temp['name'].'"}';
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
        $this->Client->id = $id;
        if(!empty($this->data)){
            if($this->Client->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Client updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'clients', 'action' => 'edit', $this->Client->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Client now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'clients', 'action' => 'edit', $this->Client->id));
            }
        }

        $this->data = $this->Client->read();
        //print_r($this->data); die;

        
        $this->render('add');
    }
    
    public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Client.name like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Client"]["order"]="Client.created DESC";
        
        $clients = $this->paginate('Client', $options);
        //pr($categories);
        $this->set(compact('clients','search'));
        
        
        //$this->set("search",$search);
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
