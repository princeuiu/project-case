<?php

App::uses('AppController', 'Controller');


class HistoriesController extends AppController {

    public $name = 'Histories';

    public $uses = array('History', 'Lawsuit', 'Client', 'Activity','Court');

    /**
     *
     */
    public function add(){
        $this->check_access(array('employee', 'manager','admin'));

        if(!empty($this->data)){
            $historyData = $this->data;
            $splitTime  = explode('/', $historyData['History']['reporting_date']);
            $historyData['History']['reporting_date'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            $lawsuitId = $historyData['History']['lawsuit_id'];
//            $title = $this->data['History']['title'];
//            $description = $this->data['History']['description'];
//            $reporting_date = $this->data['History']['reporting_date'];
//            $remark = $this->data['History']['remark'];

            if($this->History->save($historyData)){
                $historyId = $this->History->id;
                $userId = Authsome::get("id");
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History added successfully.') . '</div>');

                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("history","new",$historyId,$userId,$lawsuitId,'');
                return $this->redirect(array('controller' => 'histories'));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return;
            }
        }
        $years = array();
        $currentYear = intval(date('o'));
        for($i=1972;$i <= $currentYear; $i++){
            $years[$i] = $i;
        }
        $options = array(
            'NOT' => array(
                'parent_id' => 0, 
            ),
        );
        /*$courts = $this->Court->generateTreeList($options,null,null," - ");*/

        
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
        
        $lawsuits = $this->Lawsuit->find('list', array(
            'fields' => array('Lawsuit.id', 'Lawsuit.number', 'Lawsuit.case_no'),
            'conditions' => array('Lawsuit.status'=>'active')
        ));
        //pr($lawsuits); die();

        $this->set(compact('lawsuits','courts', 'categories','years'));
    }


    public function newhistory($id){
        $this->check_access(array('employee', 'manager','admin'));

        if(!empty($this->data)){
            $historyData = $this->data;
            $splitTime  = explode('/', $historyData['History']['reporting_date']);
            $historyData['History']['reporting_date'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            $lawsuitId = $historyData['History']['lawsuit_id'];
//            $title = $this->data['History']['title'];
//            $description = $this->data['History']['description'];
//            $reporting_date = $this->data['History']['reporting_date'];
//            $remark = $this->data['History']['remark'];

            if($this->History->save($historyData)){
                $historyId = $this->History->id;
                $userId = Authsome::get("id");
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History added successfully.') . '</div>');

                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("history","new",$historyId,$userId,$lawsuitId,'');
                return $this->redirect(array('controller' => 'histories', 'action' => 'calender', $this->History->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return;
            }
        }
        $options = array(
            'NOT' => array(
                'parent_id' => null,
            ),
        );
        $lawsuits = $this->Lawsuit->find('list', array(
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
            'conditions' => array('Lawsuit.id' => $id)
        ));

//        $lawsuits = $this->Lawsuit->find('list', array(
//            'conditions' => array('Lawsuit.id' => $id),
//            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
//        ));
//        pr($lawsuits);

        $this->set(compact('lawsuits'));
    }
    
    public function ajax_get_court_name(){
        $data = $_POST['data'];
        $options = array(
            'conditions' => array('History.lawsuit_id' => $data['id']), //array of conditions
            'recursive' => -1, //int
            'fields' => array('History.court_name')
        );
        $result = $this->History->find('first', $options);
        if(!empty($result)){
            Echo $result['History']['court_name'];
        }
        else{
            Echo false;
        }
        exit;
    }

    public function calender(){
        $this->check_access(array('employee', 'manager','admin'));

        $histories = $this->History->find('all', array(
//            'fields' => array('History.reporting_date', 'History.title', 'History.id'),
            'conditions' => array('History.status'=>'pending')
        ));
//        print_r($histories); die;
        $this->set(compact('histories'));
    }

    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->History->id = $id;
        if(!empty($this->data)){
            $historyData = $this->data;
            //print_r($historyData); die;
            $splitTime  = explode('/', $historyData['History']['reporting_date']);
            $splitTimeCount = count($splitTime);
            if($splitTimeCount == 3){
                $historyData['History']['reporting_date'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            }
            $newData = $this->History->read();
            $lawsuitId = $newData['History']['lawsuit_id'];
            if($this->History->save($historyData)){
                $historyId = $this->History->id;
                $userId = Authsome::get("id");
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('History updated successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("history","update",$historyId,$userId,$lawsuitId,'');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save History now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'histories', 'action' => 'edit', $this->History->id));
            }
        }
        $this->set(compact('lawsuits'));
        $this->data = $this->History->read();
        $lawsuits = $this->Lawsuit->find('list', array(
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
            'conditions' => array('Lawsuit.number'=>$this->data['Lawsuit']['number'])
        ));
        $this->set(compact('lawsuits'));
        $this->render('edit');
    }


    public function view($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $historyData = $this->History->find('first',array(
            'conditions' => array('History.id' => $id)
        ));
        $clientId = $historyData['Lawsuit']['client_id'];
        $lawsuitNumber = $historyData['Lawsuit']['number'];
        $clientInfo = $this->Client->find('first',array(
            'conditions' => array('Client.id' => $clientId),
            'recursive' => -1
        ));
        $this->set(compact('historyData','clientInfo', 'lawsuitNumber', 'id'));
        $this->render('view');
    }


    public function timeline($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $timelineData = $this->History->find('all',array(
            'conditions' => array('History.lawsuit_id' => $id),
            'order' => array('History.reporting_date DESC')
        ));
//        print_r($timelineData);die;
        $this->set(compact('timelineData'));
        $this->render('timeline');
    }


    /*public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);

        if(isset($search)){
            $options["Client.name like"]="%$search%";
        }
        else $search="";

        $this->paginate["History"]["created"]="History.created DESC";

        $cases = $this->paginate('Lawsuit', $options);

        $this->loadModel('Court');
        $allCourts = $this->Court->find('list', array(
            'conditions' => array('Court.status' => 'active'),
            'fields' => array('Court.id', 'Court.name')
        ));

        //$history = $this->History->find('all',array('recurcive'=> 2));
      // pr($cases);die;
        $this->set(compact('cases','search','allCourts'));

        //pr($allCourts); die();


        //$this->set("search",$search);
    }*/
    
    public function index() {

        $this->check_access(array('employee', 'manager','admin'));

        
        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];
        extract($this->request->params["named"]);
        
        if(!empty($this->data)){
            $searchData = $this->data;
            if(array_key_exists('dateFrom',$searchData) && array_key_exists('dateTo',$searchData)){
                $splitDateFrom  = explode('/', $searchData['dateFrom']);
                $dateFrom = $splitDateFrom[2] . '-' . $splitDateFrom[0] . '-' . $splitDateFrom[1];
                
                $splitDateTo  = explode('/', $searchData['dateTo']);
                $dateTo = $splitDateTo[2] . '-' . $splitDateTo[0] . '-' . $splitDateTo[1];
                
                $this->Paginator->settings = array(
                    'conditions' => array('History.reporting_date >=' => $dateFrom, 'History.reporting_date <=' => $dateTo),
                    'limit' => 10,
                    'order' => 'History.created ASC'
                );
            }
            elseif(array_key_exists('pCourt',$searchData) && array_key_exists('court',$searchData) && array_key_exists('year',$searchData)){
                $courtId = $searchData['court'];
                $year = $searchData['year'];
                $options = array(
                    'fields' => array('Lawsuit.id'),
                    'conditions' => array('Lawsuit.status =' => 'active', 'Lawsuit.court_id =' => $courtId, 'Lawsuit.year =' => $year),
                    'recursive' => 0
                );
                
                $lawsuitList = $this->Lawsuit->find('list', $options);
//                print_r($lawsuitList); die;
                $this->Paginator->settings = array(
                    'conditions' => array('History.status'=>'pending', 'History.lawsuit_id' => $lawsuitList),
                    'limit' => 10,
                    'order' => 'History.created ASC'
                );
            }
        }
        else{
            $this->Paginator->settings = array(
                'conditions' => array('History.status'=>'pending', 'History.reporting_date >=' => date('Y-m-d')),
                'limit' => 10,
                'order' => 'History.created ASC'
            );
        }
        
        $histories = $this->Paginator->paginate('History');
        
        
        
        
        
//        $histories = $this->History->find('all', array(
////            'fields' => array('History.reporting_date', 'History.title', 'History.id'),
//            'conditions' => array('History.status'=>'pending', 'History.reporting_date >=' => date('Y-m-d'))
//        ));
        $allCourts = $this->Court->find('list', array(
            'conditions' => array('Court.status' => 'active'),
            'fields' => array('Court.id', 'Court.name')
        ));
//        print_r($allCourts); die;
        $historiesData = $histories;
        $count = 0;
        foreach($histories as $eachHistory){
            $parentInfo = $this->Court->getParentNode($eachHistory['Lawsuit']['court_id']);
            $historiesData[$count]['Lawsuit']['courtPrefix'] = $parentInfo['Court']['name'].' - '.$allCourts[$eachHistory['Lawsuit']['court_id']].' - ';
            $count++;
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
        $years = array();
        $currentYear = intval(date('o'));
        for($i=1972;$i <= $currentYear; $i++){
            $years[$i] = $i;
        }
        
//        print_r($historiesData); die;
        $this->set(compact('historiesData', 'courts', 'categories', 'years', 'controller', 'action'));
    }
    
    
    
    public function client_case_update() {

        $this->check_access(array('employee', 'manager','admin'));

        
        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];
        extract($this->request->params["named"]);
        
        if(!empty($this->data)){
            $searchData = $this->data;
            if(array_key_exists('client',$searchData) && array_key_exists('court',$searchData) && array_key_exists('year',$searchData)){
                
                $clienttId = $searchData['client'];
                $courtId = $searchData['court'];
                $year = $searchData['year'];
                $options = array(
                    'fields' => array('Lawsuit.id'),
                    'conditions' => array('Lawsuit.status =' => 'active', 'Lawsuit.client_id =' => $clienttId, 'Lawsuit.court_id =' => $courtId, 'Lawsuit.year =' => $year),
                    'recursive' => 0
                );
                
                $lawsuitList = $this->Lawsuit->find('list', $options);
                
                $this->Paginator->settings = array(
                    'conditions' => array('History.status'=>'pending', 'History.lawsuit_id' => $lawsuitList),
                    'limit' => 10,
                    'order' => 'History.created ASC'
                );
                
                $histories = $this->Paginator->paginate('History');
        
                $allCourts = $this->Court->find('list', array(
                    'conditions' => array('Court.status' => 'active'),
                    'fields' => array('Court.id', 'Court.name')
                ));

                $historiesData = $histories;
                $count = 0;
                foreach($histories as $eachHistory){
                    $parentInfo = $this->Court->getParentNode($eachHistory['Lawsuit']['court_id']);
                    $historiesData[$count]['Lawsuit']['courtPrefix'] = $parentInfo['Court']['name'].' - '.$allCourts[$eachHistory['Lawsuit']['court_id']].' - ';
                    $count++;
                }
                
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
        $years = array();
        $currentYear = intval(date('o'));
        for($i=1972;$i <= $currentYear; $i++){
            $years[$i] = $i;
        }
        $clientsList = $this->Client->find('all', array(
            'conditions' => array('Client.status' => 'active'),
            'recursive' => -1,
            'fields' => array('Client.id', 'Client.name', 'Client.branch')
        ));
        $clients = array();
        foreach($clientsList as $clientData){
            if($clientData['Client']['branch'] != ''){
                $clients[$clientData['Client']['id']] = $clientData['Client']['name'] . ' - ' . $clientData['Client']['branch'];
            }
            else{
                $clients[$clientData['Client']['id']] = $clientData['Client']['name'];
            }
            
        }
        
//        print_r($historiesData); die;
        $this->set(compact('historiesData', 'courts', 'categories', 'years', 'controller', 'action', 'clients'));
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
