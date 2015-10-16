<?php

App::uses('AppController', 'Controller');


class CourtsController extends AppController {

    public $name = 'Courts';
    
    public $uses = array('Court');
    
    public function add(){
        if(!empty($this->data)){
            //print_r($this->data); die;
            $data = $this->data;
            if($data['Court']['parent_id'] == null){
                $data['Court']['parent_id'] = 1;
            }
            if($this->Court->save($data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Court added successfully.') . '</div>');
                $this->redirect(array('controller' => 'courts', 'action' => 'index'));
                return true;
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Court now, Please try again later.') . '</div>');
                return;
            }
        }
        
        $options = array(
            'NOT' => array(
                'parent_id' => 0, 
            ),
        );
        $parents = $this->Court->generateTreeList($options,null,null," - ");
//        $directChildren = $this->Court->children(1, true);
//        print_r($directChildren); die;
        
        $this->set(compact('parents'));
        
    }
    
    
    public function edit($id = null){
        if($id == null){
            throw new BadRequestException();
        }
        $this->Court->id = $id;
        if(!empty($this->data)){
            //print_r($this->data); die;
            $data = $this->data;
            if($data['Court']['parent_id'] == null){
                $data['Court']['parent_id'] = 0;
            }
            if($this->Court->save($data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Court added successfully.') . '</div>');
                $this->redirect(array('controller' => 'courts', 'action' => 'index'));
                return true;
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Court now, Please try again later.') . '</div>');
                return;
            }
        }
        
        $options = array(
            'NOT' => array(
                'parent_id' => null, 
            ),
        );
        $parents = $this->Court->generateTreeList($options,null,null," - ");
        //print_r($parents); die;
        $this->data = $this->Court->read();
        $this->set(compact('parents'));
        $this->render('add');
        
    }

    public function admin_add(){
        if(!empty($this->data)){
            $upImage = $this->data['Court']['image'];
            $upDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'original' . DS;
            $upImgData = array('file' => $upImage, 'path' => $upDir);
            $upImgName = $this->Qimage->copy($upImgData);
            if($upImgName){
                $catData = $this->data;
                unset($empData['Court']['image']);
                $catData['Court']['image'] = $upImgName;
                $resizeDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'resize' . DS;
                $thumbDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'thumb' . DS;
                $resizeImgData = array(
                    'file' => $upDir . $upImgName,
                    'width' => '400',
                    'output' => $resizeDir
                    );
                $thumbImgData = array(
                    'file' => $upDir . $upImgName,
                    'width' => '85',
                    'output' => $thumbDir
                    );
                if($this->Qimage->resize($resizeImgData)){
                    if($this->Qimage->resize($thumbImgData)){
                        if($this->Court->save($catData)){
                            $this->Session->setFlash('<div class="alert alert-success">' . __('Court added successfully.') . '</div>');
                            return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Court->id));
                        }
                        else{
                            $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Court now, Please try again later.') . '</div>');
                            return;
                        }
                    }
                }
            }
            $imgUpErr = $this->Qimage->getErrors();
            if(!empty($imgUpErr)){
                $error = implode(',', $imgUpErr);
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Court now, Please try again later.' . $error) . '</div>');
            }
        }
    }
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Court->id = $id;
        if(!empty($this->data)){
            if($this->data['Court']['image']['error'] != 4 || $this->data['Court']['image']['name'] !=null){
                $upImage = $this->data['Court']['image'];
                $upDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'original' . DS;
                $upImgData = array('file' => $upImage, 'path' => $upDir);
                $upImgName = $this->Qimage->copy($upImgData);
                if($upImgName){
                    $catData = $this->data;
                    unset($catData['Court']['image']);
                    $catData['Court']['image'] = $upImgName;
                    $resizeDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'resize' . DS;
                    $thumbDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'thumb' . DS;
                    $resizeImgData = array(
                        'file' => $upDir . $upImgName,
                        'width' => '400',
                        'output' => $resizeDir
                        );
                    $thumbImgData = array(
                        'file' => $upDir . $upImgName,
                        'width' => '85',
                        'output' => $thumbDir
                        );
                    if($this->Qimage->resize($resizeImgData)){
                        if($this->Qimage->resize($thumbImgData)){
                            if($this->Court->save($catData)){
                                $this->Session->setFlash('<div class="alert alert-success">' . __('Court info updated successfully.') . '</div>');
                                return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Court->id));
                            }
                            else{
                                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Court info now, Please try again later.') . '</div>');
                                return;
                            }
                        }
                    }
                }
                $imgUpErr = $this->Qimage->getErrors();
                if(!empty($imgUpErr)){
                    $error = implode(',', $imgUpErr);
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Court info now, Please try again later.' . $error) . '</div>');
                }
            }
            else{
                $catData = $this->data;
                unset($catData['Court']['image']);
                if($this->Court->save($catData)){
                    $this->Session->setFlash('<div class="alert alert-success">' . __('Court info updated successfully.') . '</div>');
                    return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Court->id));
                }
                else{
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Court info now, Please try again later.') . '</div>');
                    return;
                }
            }
        }

        $this->data = $this->Court->read();

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Court.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Court"]["order"]="Court.created DESC";
        
        $departments = $this->paginate('Court', $options);
        //pr($categories);
        $this->set(compact('departments','search'));
        
        
        //$this->set("search",$search);
    }
    
    public function index(){
        
        $this->check_access(array('employee', 'manager','admin'));

        //print_r($this->request->params); die;
        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];
        extract($this->request->params["named"]);
        
        if(isset($key) && isset($val)){
            //$options["Lawsuit.title like"]="%$search%";
            if($key == 'name' || $key == 'contact_person'){
                $this->Paginator->settings = array(
                    'conditions' => array('Client.'.$key.' LIKE' => "%$val%"),
                    'limit' => 10,
                    'order' => 'Lawsuit.created DESC'
                );
            }
            else{
                $this->Paginator->settings = array(
                    'conditions' => array('Lawsuit.'.$key.' LIKE' => "%$val%"),
                    'limit' => 10,
                    'order' => 'Court.created DESC'
                );
            }
        }
        else{
            $this->Paginator->settings = array(
                'limit' => 10,
                'order' => 'Court.created DESC'
            );
        }
        
        //$items = $this->Paginator->paginate('Court');
        
        $options = array(
            'NOT' => array(
                'parent_id' => 0, 
            ),
        );
        $items = $this->Court->generateTreeList($options,null,null," - ");
        print_r($items); die;
        
        $this->set(compact('items'));
        
    }
    
    
    
    function admin_remove_image($name) {
        $this->Court->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/categories/original/".$name);
        @unlink(WWW_ROOT."img/categories/resize/".$name);
        @unlink(WWW_ROOT."img/categories/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }

}