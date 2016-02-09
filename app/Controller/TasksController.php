<?php

App::uses('AppController', 'Controller');


class TasksController extends AppController {

    public $name = 'Tasks';

    public $uses = array('Task','Lawsuit', 'TaskComment', 'Client','User', 'Follower', 'Activity', 'WantingDoc','Tasklist','Court');

    public function add(){
        $this->check_access(array('manager','admin'));


        if(!empty($this->data)){
//            print_r($this->data);die;
            $data = $this->data;
            //print_r($data); die;
            $splitTime  = explode('/', $data['Task']['dead_line']);
            $data['Task']['dead_line'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            $followers = $data['Task']['follower'];
            $taskOwner = $data['Task']['owner'];
            $taskAssigned = $data['Task']['assigned_to'];
            unset($data['Task']['follower']);
            if($this->Task->save($data)){
                $taskId = $this->Task->id;

                $path = WWW_ROOT . 'uploads' . DS . 'doc' . DS;
                $commentId =0;
                $files = $this->data['Task']['files'];
                $i = 0;
                while($i < count($files)){
                    if ($files[$i]['error'] == 0){
                        $fileData = array(
                            'WantingDoc' => array(
                                'task_id' => $taskId,
                                'comment_id' => $commentId,
                                'name' => 't' . $taskId . 'c' . $commentId . $files[$i]['name'],
                                'path' => $path
                            )
                        );
                        //print_r($fileData);
                        $this->WantingDoc->create();
                        if($this->WantingDoc->save($fileData)) {
                            if (move_uploaded_file($files[$i]['tmp_name'], ($path.'t' . $taskId . 'c' . $commentId . $files[$i]['name']))) {
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                        unset($fileData);
                    }
                    $i = $i + 1;
                }

                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task added successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("task","new",$taskId,$taskOwner,$taskAssigned,'');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'owned', $this->Task->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Task now, Please try again later.') . '</div>');
                return;
            }
        }

        $lawsuits = $this->Lawsuit->find('list', array(
            'conditions' => array('Lawsuit.status' => 'active'),
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
        ));
        //print_r($lawsuits); die;
        $users = $this->User->find('list', array(
            'conditions' => array('User.status' => 'active', 'User.role' => 'employee')
        ));
        //pr($users);
        $this->set(compact('lawsuits', 'users'));
    }

    public function newtask($id){
        $this->check_access(array('manager','admin'));


        if(!empty($this->data)){
//            print_r($this->data);die;
            $data = $this->data;
            //print_r($data); die;
            $splitTime  = explode('/', $data['Task']['dead_line']);
            $data['Task']['dead_line'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            $followers = $data['Task']['follower'];
            $taskOwner = $data['Task']['owner'];
            $taskAssigned = $data['Task']['assigned_to'];
            unset($data['Task']['follower']);
            if($this->Task->save($data)){
                $taskId = $this->Task->id;

                $path = WWW_ROOT . 'uploads' . DS . 'doc' . DS;
                $commentId =0;
                $files = $this->data['Task']['files'];
                $i = 0;
                while($i < count($files)){
                    if ($files[$i]['error'] == 0){
                        $fileData = array(
                            'WantingDoc' => array(
                                'task_id' => $taskId,
                                'comment_id' => $commentId,
                                'name' => 't' . $taskId . 'c' . $commentId . $files[$i]['name'],
                                'path' => $path
                            )
                        );
                        //print_r($fileData);
                        $this->WantingDoc->create();
                        if($this->WantingDoc->save($fileData)) {
                            if (move_uploaded_file($files[$i]['tmp_name'], ($path.'t' . $taskId . 'c' . $commentId . $files[$i]['name']))) {
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                        unset($fileData);
                    }
                    $i = $i + 1;
                }

                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task added successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("task","new",$taskId,$taskOwner,$taskAssigned,'');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'owned', $this->Task->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t save Task now, Please try again later.') . '</div>');
                return;
            }
        }
        $lawsuits = $this->Lawsuit->find('list', array(
            'conditions' => array('Lawsuit.id' => $id),
            'fields' => array('Lawsuit.id', 'Lawsuit.number')
        ));
        $lawsuitType = $this->Lawsuit->find('first', array(
            'conditions' => array('Lawsuit.id' => $id),
            'fields' => array('Lawsuit.type'),
            'recursive' => -1
        ));
        //print_r($lawsuitType); die;
        $users = $this->User->find('list', array(
            'conditions' => array('User.status' => 'active', 'User.role' => 'employee')
        ));
        
        $taskLists = $this->Tasklist->find('list', array(
            'conditions' => array('Tasklist.status' => 'active', 'Tasklist.type' => $lawsuitType['Lawsuit']['type'])
        ));
        //pr($users);
        $this->set(compact('lawsuits', 'users','taskLists'));
    }

    public function edit($id) {
        $this->check_access(array('employee', 'manager','admin'));

        if($id == null){
            throw new BadRequestException();
        }
        $this->Task->id = $id;
        if(!empty($this->data)){
            $data = $this->data;
            //print_r($this->data); die;
            $splitTime  = explode('/', $data['Task']['dead_line']);
            $splitTimeCount = count($splitTime);
            if($splitTimeCount == 3){
                $data['Task']['dead_line'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            }
            $followers = $data['Task']['follower'];
            unset($data['Task']['follower']);
            if($this->Task->save($data)){
                $taskId = $this->Task->id;
                $taskOwner = $data['Task']['owner'];
                $taskAssigned = $data['Task']['assigned_to'];
                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                else{
                    $this->Task->removeFowllers($taskId);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task Updated successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("task","update",$taskId,$taskOwner,$taskAssigned,'');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'edit', $this->Task->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t update Task now, Please try again later.') . '</div>');
                return;
            }
        }

        $this->data = $this->Task->read();
        if(empty($this->data)){
            throw new NotFoundException;
        }
        //print_r($this->data); die;
        $followerUsers = $this->data['FollowerUser'];
        $followers = array();
        foreach($followerUsers as $followerUser){
            $followers[] = $followerUser['id'];
        }
        //$this->data['Task']['follower'] = $followers;
        //print_r($this->data); die;

        $lawsuits = $this->Lawsuit->find('list', array(
            'conditions' => array('Lawsuit.status' => 'active'),
            'fields' => array('Lawsuit.id', 'Lawsuit.number'),
        ));
        $users = $this->User->find('list', array(
            'conditions' => array('User.status' => 'active', 'User.role' => 'employee')
        ));
        //print_r($users); die;
        $this->set(compact('lawsuits', 'users', 'followers'));


        //$this->render('admin_add');
    }

    public function index() {
        $this->check_access(array('employee', 'manager','admin'));

        extract($this->params["named"]);

        if(isset($search)){
            $options["Task.title like"]="%$search%";
        }
        else $search="";

        $this->paginate["Task"]["order"]="Task.created DESC";

        $brands = $this->paginate('Task', $options);
        //pr($categories);
        $this->set(compact('brands','search'));


        //$this->set("search",$search);
    }

    public function all(){
        $this->check_access(array('employee', 'manager','admin'));

        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.assigned_to' => Authsome::get("id"), 'Task.status' => 'pending'),
            'order' => array('Task.dead_line ASC'),
            'fields' => array('Task.id', 'Task.description', 'Task.wanting_doc', 'Task.dead_line', 'Lawsuit.number', 'Lawsuit.slug','Tasklist.name', 'Tasklist.slug' )
        );
        $userTasks = $this->Task->find('all', $options);

        $tasks = array();

        $now = time();
        $count = 0;
        foreach($userTasks as $userTask){
            $dead_line = strtotime($userTask['Task']['dead_line']);
            $datediff = $dead_line - $now;
            $tasks[$count] = $userTask;
            $tasks[$count]['Task']['datediff'] = floor($datediff/(60*60*24));
            if($tasks[$count]['Task']['datediff'] < 0){
                $tasks[$count]['Task']['datedifftxt'] = $tasks[$count]['Task']['datediff'] * (-1);
                $tasks[$count]['Task']['datedifftxt'] = '<span style="color:red;">'.$tasks[$count]['Task']['datedifftxt'].' day(s) over<span>';
            }
            else{
                $tasks[$count]['Task']['datedifftxt'] = '<span>'.$tasks[$count]['Task']['datediff'].' day(s) left<span>';
            }
            $count++;
        }

        //print_r($tasks); die;

        $this->set(compact('tasks'));
    }

    public function owned(){
        $this->check_access(array('employee', 'manager','admin'));

        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.owner' => Authsome::get("id"), 'Task.status' => 'pending'),
            'order' => array('Task.dead_line ASC'),
            'fields' => array('Task.id', 'Task.description', 'Task.wanting_doc', 'Task.dead_line', 'Lawsuit.number', 'Lawsuit.slug','Tasklist.name', 'Tasklist.slug' )
        );
        $userTasks = $this->Task->find('all', $options);
        //print_r($userTasks); die;
        $tasks = array();

        $now = time();
        $count = 0;
        foreach($userTasks as $userTask){
            $dead_line = strtotime($userTask['Task']['dead_line']);
            $datediff = $dead_line - $now;
            $tasks[$count] = $userTask;
            $tasks[$count]['Task']['datediff'] = floor($datediff/(60*60*24));
            if($tasks[$count]['Task']['datediff'] < 0){
                $tasks[$count]['Task']['datedifftxt'] = $tasks[$count]['Task']['datediff'] * (-1);
                $tasks[$count]['Task']['datedifftxt'] = '<span style="color:red;">'.$tasks[$count]['Task']['datedifftxt'].' day(s) over<span>';
            }
            else{
                $tasks[$count]['Task']['datedifftxt'] = '<span>'.$tasks[$count]['Task']['datediff'].' day(s) left<span>';
            }
            $count++;
        }

        //print_r($tasks); die;

        $this->set(compact('tasks'));

        $this->render('all');
    }


    public function details($id){
        $this->check_access(array('employee', 'manager','admin'));
        
        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.id' => $id),
            'order' => array('Task.dead_line ASC')
        );
        $userTasks = $this->Task->find('first', $options);
        //print_r($userTasks); die;
        $options = array(
            'conditions' => array('TaskComment.task_id' => $id),
            'order' => array('TaskComment.created DESC')
        );
        $taskComments = $this->TaskComment->find('all', $options);
        //print_r($taskComments); die;
        $now = time();
        $dead_line = strtotime($userTasks['Task']['dead_line']);
        $datediff =  floor(($dead_line - $now)/(60*60*24));
        $task_files = $this->WantingDoc->find('all', array('conditions'=>array('WantingDoc.task_id'=>$id,'WantingDoc.done'=>1)));
        $caseNmeTxt = '';
        if($userTasks['Lawsuit']['type'] == 'litigation'){
            $courtTypeId = $userTasks['Lawsuit']['court_id'];
            $courtTypeInfo = $this->Court->find('first', array(
                'conditions' => array('Court.id' => $courtTypeId),
                'recursive' => -1
            ));
            $l2Parent = $this->Court->getParentNode($courtTypeId);
            $l1Parent = $this->Court->getParentNode($l2Parent['Court']['id']);
            $caseNmeTxt = $l1Parent['Court']['name'].' - '.$l2Parent['Court']['name'].' - '.$courtTypeInfo['Court']['name'].' - ';
        }

        //print_r($userTasks); die;
        $this->set(compact('userTasks', 'datediff', 'taskComments','task_files','caseNmeTxt'));
    }



}
