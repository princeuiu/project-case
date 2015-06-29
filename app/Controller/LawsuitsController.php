<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');


class LawsuitsController extends AppController {

    public $name = 'Lawsuits';
    
    public $uses = array('Lawsuit','Client');
    
    public function review() {
        $queLimit = 5;
        if(!isset($_SESSION['rateIds'])){
            return $this->redirect(array('controller' => 'Lawsuits', 'action' => 'index', 'admin' => true));
        }
        $itemIds = $_SESSION['rateIds'];
        
        $questions = $this->Question->find('all',array(
            'conditions' => array('Question.status' => 'active'),
            'order' => array('Question.created ASC'),
            'limit' => $queLimit,
        ));
        
        $items = $this->Lawsuit->find('all',array(
            'conditions' => array('Lawsuit.id' => $itemIds, 'Lawsuit.status' => 'active'),
        ));
        //pr($items); die;
        $title = 'Your Opinion Matter for Us!';
        $this->set(compact('items', 'questions', 'title'));
    }

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
        
        $this->Lawsuit->unbindModel(
            array('hasMany' => array('Rateing'))
        );
        
        $itemData = $this->Lawsuit->find('first', array(
            'conditions' => array('Lawsuit.slug' => $slug)
        ));
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-0 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataToDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 week'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastWeek = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-6 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastSixMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 year'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
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
        $itemsData = $this->Lawsuit->find('all', array(
            'conditions' => array('Category.slug' => $slug),
            'order' => array('Lawsuit.rating DESC'),
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
        
        $this->Lawsuit->unbindModel(
            array('hasMany' => array('Rateing'))
        );
        
        $itemData = $this->Lawsuit->find('first', array(
            'conditions' => array('Lawsuit.slug' => $slug)
        ));
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-0 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataToDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 day'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastDay = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 week'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                )
        );
        $dataLastWeek = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-6 month'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastSixMonth = $this->Rateing->find('all', $options);
        
        $this->Rateing->unbindModel(
            array('belongsTo' => array('Lawsuit'))
        );
        $date = date('Y-m-d', strtotime('-1 year'));
        $options = array(
            'conditions' => array(
                    'Rateing.item_id' => $itemData["Lawsuit"]["id"],
                    'Rateing.created >' => $date
                ),
            'order' => array('Rateing.created DESC')
        );
        $dataLastYear = $this->Rateing->find('all', $options);
        
        //pr($empData);
        $this->set(compact('itemData','dataToDay', 'dataLastDay', 'dataLastWeek', 'dataLastMonth', 'dataLastSixMonth', 'dataLastYear'));
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
