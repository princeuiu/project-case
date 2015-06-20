<?php

App::uses('AppController', 'Controller');


class UnitsController extends AppController {

    public $name = 'Units';
    
    public $theme = 'InflackPos';

    public function admin_add(){
        if(!empty($this->data)){
            if($this->Unit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Unit added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'units', 'action' => 'edit', $this->Unit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Unit now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Unit->id = $id;
        if(!empty($this->data)){
            if($this->Unit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Unit updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'units', 'action' => 'edit', $this->Unit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Unit now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'units', 'action' => 'edit', $this->Unit->id));
            }
        }

        $this->data = $this->Unit->read();
        //print_r($this->data); die;

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Unit.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Unit"]["order"]="Unit.created DESC";
        
        $units = $this->paginate('Unit', $options);
        //pr($categories);
        $this->set(compact('units','search'));
        
        
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
