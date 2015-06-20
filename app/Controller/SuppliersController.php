<?php

App::uses('AppController', 'Controller');


class SuppliersController extends AppController {

    public $name = 'Suppliers';
    
    public $theme = 'InflackPos';

    public function admin_add(){
        if(!empty($this->data)){
            if($this->Supplier->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Supplier added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'suppliers', 'action' => 'edit', $this->Supplier->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Supplier now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Supplier->id = $id;
        if(!empty($this->data)){
            if($this->Supplier->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Supplier updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'suppliers', 'action' => 'edit', $this->Supplier->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Supplier now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'suppliers', 'action' => 'edit', $this->Supplier->id));
            }
        }

        $this->data = $this->Supplier->read();
        //print_r($this->data); die;

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Supplier.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Supplier"]["order"]="Supplier.created DESC";
        
        $suppliers = $this->paginate('Supplier', $options);
        //pr($categories);
        $this->set(compact('suppliers','search'));
        
        
        //$this->set("search",$search);
    }
    
    public function index(){
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Category.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Category"]["order"]="Category.created DESC";
        
        $categories = $this->paginate('Category', $options);
        $count = count($categories);
        $itemEachRow = $count / 3;
        //pr($categories);
        $this->set(compact('categories','search', 'itemEachRow'));
    }
    
    public function admin_delete($id) {
        if($id == null){
            throw new BadRequestException();
        }
    }
    
    function admin_remove_image($name) {
        $this->Category->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/categories/original/".$name);
        @unlink(WWW_ROOT."img/categories/resize/".$name);
        @unlink(WWW_ROOT."img/categories/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }

}
