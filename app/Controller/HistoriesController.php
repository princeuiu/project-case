<?php

App::uses('AppController', 'Controller');


class HistoriesController extends AppController {

    public $name = 'Histories';

    public $uses = array('History', 'Lawsuit');

    public function admin_add(){
        if(!empty($this->data)){
            $lawsuit_id = $this->data['History']['lawsuit_id'];
            $title = $this->data['History']['title'];
            $description = $this->data['History']['description'];
            $reporting_date = $this->data['History']['reporting_date'];
            $remark = $this->data['History']['remark'];

            if($this->History->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return;
            }
//                if($this->Qimage->resize($resizeImgData)){
//                    if($this->Qimage->resize($thumbImgData)){
//                        if($this->Category->save($catData)){
//                            $this->Session->setFlash('<div class="alert alert-success">' . __('Category added successfully.') . '</div>');
//                            return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Category->id));
//                        }
//                        else{
//                            $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Category now, Please try again later.') . '</div>');
//                            return;
//                        }
//                    }
//                }
//            }
//            $imgUpErr = $this->Qimage->getErrors();
//            if(!empty($imgUpErr)){
//                $error = implode(',', $imgUpErr);
//                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Category now, Please try again later.' . $error) . '</div>');
//            }
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

    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Category->id = $id;
        if(!empty($this->data)){
            if($this->data['Category']['image']['error'] != 4 || $this->data['Category']['image']['name'] !=null){
                $upImage = $this->data['Category']['image'];
                $upDir = WWW_ROOT . 'img' . DS . 'categories' . DS . 'original' . DS;
                $upImgData = array('file' => $upImage, 'path' => $upDir);
                $upImgName = $this->Qimage->copy($upImgData);
                if($upImgName){
                    $catData = $this->data;
                    unset($catData['Category']['image']);
                    $catData['Category']['image'] = $upImgName;
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
                            if($this->Category->save($catData)){
                                $this->Session->setFlash('<div class="alert alert-success">' . __('Category info updated successfully.') . '</div>');
                                return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Category->id));
                            }
                            else{
                                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Category info now, Please try again later.') . '</div>');
                                return;
                            }
                        }
                    }
                }
                $imgUpErr = $this->Qimage->getErrors();
                if(!empty($imgUpErr)){
                    $error = implode(',', $imgUpErr);
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Category info now, Please try again later.' . $error) . '</div>');
                }
            }
            else{
                $catData = $this->data;
                unset($catData['Category']['image']);
                if($this->Category->save($catData)){
                    $this->Session->setFlash('<div class="alert alert-success">' . __('Category info updated successfully.') . '</div>');
                    return $this->redirect(array('controller' => 'categories', 'action' => 'edit', $this->Category->id));
                }
                else{
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Category info now, Please try again later.') . '</div>');
                    return;
                }
            }
        }

        $this->data = $this->Category->read();

        $options = array(
            'NOT' => array(
                'parent_id' => 0,
            ),
        );
        $parents = $this->Category->generateTreeList(null,null,null," - ");
        //pr($parents);

        $this->set(compact('parents'));


        $this->render('admin_add');
    }

    public function admin_index() {
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
