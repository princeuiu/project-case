<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');


class ItemsController extends AppController {

    public $name = 'Items';
    public $theme = 'InflackPos';
    
    public $uses = array('Item','Category','Brand','Supplier','Unit', 'Currency');
    
    public function review() {
        $queLimit = 5;
        if(!isset($_SESSION['rateIds'])){
            return $this->redirect(array('controller' => 'Items', 'action' => 'index', 'admin' => true));
        }
        $itemIds = $_SESSION['rateIds'];
        
        $questions = $this->Question->find('all',array(
            'conditions' => array('Question.status' => 'active'),
            'order' => array('Question.created ASC'),
            'limit' => $queLimit,
        ));
        
        $items = $this->Item->find('all',array(
            'conditions' => array('Item.id' => $itemIds, 'Item.status' => 'active'),
        ));
        //pr($items); die;
        $title = 'Your Opinion Matter for Us!';
        $this->set(compact('items', 'questions', 'title'));
    }

    public function admin_add(){
        if(!empty($this->data)){
            $upImage = $this->data['Item']['image'];
            $upDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'original' . DS;
            $upImgData = array('file' => $upImage, 'path' => $upDir);
            $upImgName = $this->Qimage->copy($upImgData);
            if($upImgName){
                $empData = $this->data;
                $empData['Brand']['id'] = $empData['Item']['brand_id'];
                $empData['Supplier']['id'] = $empData['Item']['supplier_id'];
                unset($empData['Item']['image']);
                $empData['Item']['image'] = $upImgName;
                $resizeDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'resize' . DS;
                $thumbDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'thumb' . DS;
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
                        if($this->Item->saveAll($empData)){
                            $this->Session->setFlash('<div class="alert alert-success">' . __('Item added successfully.') . '</div>');
                            return $this->redirect(array('controller' => 'items', 'action' => 'edit', $this->Item->id));
                        }
                        else{
                            $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Item now, Please try again later.') . '</div>');
                            return;
                        }
                    }
                }
            }
            $imgUpErr = $this->Qimage->getErrors();
            if(!empty($imgUpErr)){
                $error = implode(',', $imgUpErr);
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Item now, Please try again later.' . $error) . '</div>');
            }
        }
        $options = array(
            'NOT' => array(
                'parent_id' => 0, 
            ),
        );
        $categories = $this->Category->generateTreeList($options,null,null," - ");
        $suppliers = $this->Supplier->find('list', array(
            'conditions' => array('Supplier.status' => 'active')
        ));
        $brands = $this->Brand->find('list', array(
            'conditions' => array('Brand.status' => 'active')
        ));
        $units = $this->Unit->find('list', array(
            'fields' => array('Unit.id', 'Unit.symbol'),
            'conditions' => array('Unit.status' => 'active')
        ));
        $currencies = $this->Currency->find('list', array(
            'fields' => array('Currency.id', 'Currency.symbol'),
            'conditions' => array('Currency.status' => 'active')
        ));
        
        $this->set(compact('categories','suppliers','brands','units', 'currencies'));
    }
    
    public function sendemail(){
        $Email = new CakeEmail();
        $Email->from(array('info@musicalsaif.com' => 'My Site'));
        $Email->to('musicalsaif@gmail.com');
        $Email->subject('About');
        $Email->send('My message');
        exit();
    }
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Item->id = $id;
        if(!empty($this->data)){
            if($this->data['Item']['image']['error'] != 4 || $this->data['Item']['image']['name'] !=null){
                $upImage = $this->data['Item']['image'];
                $upDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'original' . DS;
                $upImgData = array('file' => $upImage, 'path' => $upDir);
                $upImgName = $this->Qimage->copy($upImgData);
                if($upImgName){
                    $empData = $this->data;
                    unset($empData['Item']['image']);
                    $empData['Item']['image'] = $upImgName;
                    $resizeDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'resize' . DS;
                    $thumbDir = WWW_ROOT . 'img' . DS . 'items' . DS . 'thumb' . DS;
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
                            if($this->Item->updateAll($empData)){
                                $this->Session->setFlash('<div class="alert alert-success">' . __('Item info updated successfully.') . '</div>');
                                return $this->redirect(array('controller' => 'items', 'action' => 'edit', $this->Item->id));
                            }
                            else{
                                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Item info now, Please try again later.') . '</div>');
                                return;
                            }
                        }
                    }
                }
                $imgUpErr = $this->Qimage->getErrors();
                if(!empty($imgUpErr)){
                    $error = implode(',', $imgUpErr);
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Item info now, Please try again later.' . $error) . '</div>');
                }
            }
            else{
                $empData = $this->data;
                unset($empData['Item']['image']);
                if($this->Item->updateAll($empData)){
                    $this->Session->setFlash('<div class="alert alert-success">' . __('Item info updated successfully.') . '</div>');
                    return $this->redirect(array('controller' => 'items', 'action' => 'edit', $this->Item->id));
                }
                else{
                    $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t update Item info now, Please try again later.') . '</div>');
                    return;
                }
            }
        }

        $this->data = $this->Item->read();
        
        $options = array(
            'NOT' => array(
                'parent_id' => 0, 
            ),
        );
        $categories = $this->Category->generateTreeList($options,null,null," - ");
        $suppliers = $this->Supplier->find('list', array(
            'conditions' => array('Supplier.status' => 'active')
        ));
        $brands = $this->Brand->find('list', array(
            'conditions' => array('Brand.status' => 'active')
        ));
        $units = $this->Unit->find('list', array(
            'fields' => array('Unit.id', 'Unit.symbol'),
            'conditions' => array('Unit.status' => 'active')
        ));
        $currencies = $this->Currency->find('list', array(
            'fields' => array('Currency.id', 'Currency.symbol'),
            'conditions' => array('Currency.status' => 'active')
        ));
        
        $this->set(compact('categories','suppliers','brands','units', 'currencies'));

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Item.title like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Item"]["order"]="Item.created DESC";
        
        $items = $this->paginate('Item', $options);
        
        
        //pr($items);
        $this->set(compact('items','search'));
        
        
        //$this->set("search",$search);
    }
    
    public function ajax_addToRate(){
        $data = $_POST['data'];
        $rateIds = array();
        if(isset($_SESSION['rateIds'])){
            $rateIds = $_SESSION['rateIds'];
        }
        if(!in_array($data['id'], $rateIds)){
            $rateIds[] = $data['id'];
            $_SESSION['rateIds'] = $rateIds;
        }
        Echo true;
        exit;
    }
    
    public function ajax_removeFromRate(){
        $data = $_POST['data'];
        if(!isset($_SESSION['rateIds'])){
            Echo 'No session data found';
            exit;
        }
        $rateIds = $_SESSION['rateIds'];
        if(in_array($data['id'], $rateIds)){
            $rateIds = array_diff($rateIds, array($data['id']));
            $_SESSION['rateIds'] = $rateIds;
            Echo true;
            exit;
        }
        Echo 'error';
        exit;
    }
    
    public function admin_detail($slug = null) {
        if($slug == null){
            throw new BadRequestException();
        }
        
        $this->Item->unbindModel(
            array('hasMany' => array('Rateing'))
        );
        
        $itemData = $this->Item->find('first', array(
            'conditions' => array('Item.slug' => $slug)
        ));
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-0 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataToDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 week'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastWeek = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-6 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastSixMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 year'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastYear = $this->Rateing->find('all', $options);
        
        //pr($empData);
        $this->set(compact('itemData','dataToDay', 'dataLastDay', 'dataLastWeek', 'dataLastMonth', 'dataLastSixMonth', 'dataLastYear'));
    }
    
    public function lists($slug = null){
        if($slug == null){
            throw new BadRequestException();
        }
        $itemsData = $this->Item->find('all', array(
            'conditions' => array('Category.slug' => $slug),
            'order' => array('Item.rating DESC'),
        ));
        $count = count($itemsData);
        $itemEachRow = $count / 3;
        //pr($categories);
        $this->set(compact('itemsData', 'itemEachRow'));
    }
    
    
    public function detail($slug = null) {
        if($slug == null){
            throw new BadRequestException();
        }
        
        $this->Item->unbindModel(
            array('hasMany' => array('Rateing'))
        );
        
        $itemData = $this->Item->find('first', array(
            'conditions' => array('Item.slug' => $slug)
        ));
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-0 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataToDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 week'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastWeek = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-6 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastSixMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Item'))
        );
        $date = date('Y-m-d', strtotime('-1 year'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Item"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastYear = $this->Rateing->find('all', $options);
        
        //pr($empData);
        $this->set(compact('itemData','dataToDay', 'dataLastDay', 'dataLastWeek', 'dataLastMonth', 'dataLastSixMonth', 'dataLastYear'));
    }
    
    
    
    function admin_remove_image($name) {
        $this->Item->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/items/original/".$name);
        @unlink(WWW_ROOT."img/items/resize/".$name);
        @unlink(WWW_ROOT."img/items/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }
}
