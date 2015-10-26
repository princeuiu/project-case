<?php

App::uses('AppController', 'Controller', 'CakeEmail', 'Network/Email');


class LawsuitsController extends AppController {

    public $name = 'Lawsuits';

    public $uses = array('Lawsuit','Client', 'History', 'Task','Activity', 'Invoice','WantingDoc','Court');


    public function add(){
        $this->check_access(array('manager','admin'));

        if(!empty($this->data)){
            $tempo = $this->data;
            if($tempo['Lawsuit']['type'] == 'landvetting'){
                $tempo['Lawsuit']['court_id'] = 0;
                $tempo['Lawsuit']['year'] = null;
            }
            if (!$tempo['Lawsuit']['created'] == ''){

                $splitTime  = explode('/', $tempo['Lawsuit']['created']);
                $tempo['Lawsuit']['created'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            }else{
                $tempo['Lawsuit']['created'] = date ("Y-m-d H:i:s", time());
            }
            $tempo['Lawsuit']['created_by'] = Authsome::get("name");
            if($this->Lawsuit->save($tempo)){
////                $this->Lawsuit->saveField('created_by', Authsome::get("name"));
//                $this->Lawsuit->saveField('created_by', 'asdddds');
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case opened successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("lawsuit","new",$this->Lawsuit->id,Authsome::get("id"),0,'');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t open Case now, Please try again later.') . '</div>');
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
        $courts = $this->Court->generateTreeList($options,null,null," - ");
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
//        print_r($clients); die;

        $this->set(compact('clients','courts','years'));
    }


    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));
        if($id == null){
            throw new BadRequestException();
        }
        $this->Lawsuit->id = $id;

        if(!empty($this->data)){
            if($this->Lawsuit->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("lawsuit","update",$this->Lawsuit->id,Authsome::get("id"),0,'');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Case now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
            }
        }

        $this->data = $this->Lawsuit->read();
        
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
        $courts = $this->Court->generateTreeList($options,null,null," - ");

        $clients = $this->Client->find('list', array(
            'conditions' => array('Client.status' => 'active')
        ));
        $case_id = $id;
        $this->set(compact('clients','case_id','courts','years'));


        $this->render('add');
    }

    public function details($id) {
        $this->check_access(array('employee', 'manager','admin'));
        if($id == null){
            throw new BadRequestException();
        }
        //$this->Lawsuit->id = $id;

//        if(!empty($this->data)){
//            if($this->Lawsuit->save($this->data)){
//                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
//                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
//            }
//            else{
//                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Case now, Please try again later.') . '</div>');
//                return $this->redirect(array('controller' => 'lawsuits', 'action' => 'edit', $this->Lawsuit->id));
//            }
//        }

        //$this->data = $this->Lawsuit->read();

//        $clients = $this->Client->find('all', array(
//            'conditions' => array('Client.status' => 'active')
//        ));
        $histories = $this->History->find('all', array(
            'conditions' => array('History.lawsuit_id' => $id)
        ));
        $this_case = $this->Lawsuit->find('first', array(
            'conditions' => array('Lawsuit.id' => $id)
        ));
        $this_case_task = $this->Task->find('all', array(
            'conditions' => array('Task.lawsuit_id' => $id)
        ));
        $caseAllTask = $this->Task->find('list', array(
            'conditions' => array('Task.lawsuit_id' => $id)
        ));
        $task_files = $this->WantingDoc->find('all', array('conditions'=>array('WantingDoc.task_id'=>$caseAllTask,'WantingDoc.done'=>1)));
        $taskOfficeCopies = $this->WantingDoc->find('all', array('conditions'=>array('WantingDoc.task_id'=>$caseAllTask,'WantingDoc.office_copy'=>1)));
//        print_r($taskOfficeCopy); die;
//
        $this->set(compact('histories', 'this_case', 'this_case_task','task_files','taskOfficeCopies'));


        $this->render('detail');
    }

    public function index() {
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
                    'order' => 'Lawsuit.created DESC'
                );
            }
        }
        else{
            $this->Paginator->settings = array(
                'limit' => 10,
                'order' => 'Lawsuit.created DESC'
            );
        }
        
        $items = $this->Paginator->paginate('Lawsuit');
        
//        print_r($items); die;
        $caseType = "all";
        $this->set(compact('items', 'caseType', 'controller', 'action'));


        //$this->set("search",$search);
    }

    public function landvetting() {
        $this->check_access(array('employee', 'manager','admin'));

        
        
        $this->Paginator->settings = array(
            'conditions' => array('Lawsuit.type' => "landvetting"),
            'limit' => 10,
            'order' => 'Lawsuit.created DESC'
        );
        
        $items = $this->Paginator->paginate('Lawsuit');


        //pr($items);
        $caseType = "landvetting";
        $this->set(compact('items', 'caseType'));

        $this->render('index');
        //$this->set("search",$search);
    }

public function litigation() {
        $this->check_access(array('employee', 'manager','admin'));

        $this->Paginator->settings = array(
            'conditions' => array('Lawsuit.type' => "litigation"),
            'limit' => 10,
            'order' => 'Lawsuit.created DESC'
        );
        
        $items = $this->Paginator->paginate('Lawsuit');


        //pr($items);
    $caseType = "litigation";
    $this->set(compact('items','search', 'caseType'));

        $this->render('index');
        //$this->set("search",$search);
    }

    
    
    public function close($id = null){
        $this->check_access(array('employee', 'manager','admin'));
        if($id == null){
            throw new BadRequestException();
        }
        
        $options = array(
            'conditions' => array('Invoice.lawsuit_id' => $id,'Invoice.status' => 'paid'),
            'recursive' => -1
        );
        $hasPaidBill = $this->Invoice->find('count', $options);
        unset($options);
        $options = array(
            'conditions' => array('Invoice.lawsuit_id' => $id,'Invoice.status' => 'unpaid'),
            'recursive' => -1
        );
        $hasUnpaidBill = $this->Invoice->find('count', $options);
        if($hasPaidBill > 0 && $hasUnpaidBill == 0){
            $this->Lawsuit->id =  $id;
            $this->Lawsuit->saveField('status', 'closed');
            $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Case updated successfully.') . '</div>');
            return $this->redirect(array('controller' => 'lawsuits', 'action' => 'index'));
        }
        else{
            $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t close this case, This case don\'t have any paid bill or still have unpaid bill.') . '</div>');
            return $this->redirect(array('controller' => 'lawsuits', 'action' => 'index'));
        }
    }
    
    
    
    public function ajax_getyear(){
        
        $data = $_POST['data'];
        $id = $data['court_id'];
        $listYear = $this->Lawsuit->find('all', array(
            'conditions' => array('Lawsuit.court_id' => $id),
            'recursive' => -1,
            'fields' => array('DISTINCT Lawsuit.year')
        ));
//        $years = '';
//        foreach ($listYear as $value){
//            $years .= '{"year":"'.$value['Lawsuit']['year'].'"}';
//        }
        $years = array();
        foreach($listYear as $value){
            $years[] = $value['Lawsuit']['year'];
        }
        Echo json_encode($years);
        //print_r($listYear);
        exit;
    }
    
    public function ajax_getlawsuits(){
        
        $data = $_POST['data'];
        $courtId = $data['court_id'];
        $year = $data['year'];
        $lawsuitsData = $this->Lawsuit->find('all', array(
            'conditions' => array('Lawsuit.court_id' => $courtId,'Lawsuit.year' => $year),
            'recursive' => -1,
            'fields' => array('Lawsuit.id','Lawsuit.number')
        ));
        $lawsuitsList = array();
        foreach($lawsuitsData as $value){
            $lawsuitsList[] = array(
                'id' => $value['Lawsuit']['id'],
                'number' => $value['Lawsuit']['number']
            );
        }
        Echo json_encode($lawsuitsList);
        //print_r($lawsuitsList);
        exit;
    }

    public function test(){
        throw new BadRequestException();
    }


    function remove_image($name) {
        $this->Lawsuit->updateAll(array("image"=>"''"),array("image"=>"$name"));
        @unlink(WWW_ROOT."img/items/original/".$name);
        @unlink(WWW_ROOT."img/items/resize/".$name);
        @unlink(WWW_ROOT."img/items/thumb/".$name);
        $this->Session->setFlash('<div class="alert alert-success">' . __('Image deleted successfully.') . '</div>');
        $this->redirect($this->referer());
        exit;
    }
}
