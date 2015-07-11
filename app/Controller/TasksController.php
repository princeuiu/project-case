<?php

App::uses('AppController', 'Controller');


class TasksController extends AppController {

    public $name = 'Tasks';

    public $uses = array('Task','Lawsuit', 'TaskComment', 'Client','User', 'Follower', 'Activity');

    public function add(){
        if(!empty($this->data)){
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
                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task added successfully.') . '</div>');
                $Activity = ClassRegistry::init('Activity');
                $Activity->logintry("task","new task assigned",$taskId,$taskOwner,$taskAssigned,'');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'edit', $this->Task->id));
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

    public function edit($id) {
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
                $Activity->logintry("task","task updated",$taskId,$taskOwner,$taskAssigned,'');
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
        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.assigned_to' => Authsome::get("id"), 'Task.status' => 'pending'),
            'order' => array('Task.dead_line ASC'),
            'fields' => array('Task.id', 'Task.name', 'Task.slug', 'Task.description', 'Task.wanting_doc', 'Task.dead_line', 'Lawsuit.number', 'Lawsuit.slug' )
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
            $count++;
        }

        //print_r($tasks); die;

        $this->set(compact('tasks'));
    }
    
    public function owned(){
        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.owner' => Authsome::get("id"), 'Task.status' => 'pending'),
            'order' => array('Task.dead_line ASC'),
            'fields' => array('Task.id', 'Task.name', 'Task.slug', 'Task.description', 'Task.wanting_doc', 'Task.dead_line', 'Lawsuit.number', 'Lawsuit.slug' )
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
            $count++;
        }

        //print_r($tasks); die;

        $this->set(compact('tasks'));
        
        $this->render('all');
    }


    public function details($id){
        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.id' => $id),
            'order' => array('Task.dead_line ASC')
        );
        $userTasks = $this->Task->find('first', $options);
        $options = array(
            'conditions' => array('TaskComment.task_id' => $id),
            'order' => array('TaskComment.created DESC')
        );
        $taskComments = $this->TaskComment->find('all', $options);
        $now = time();
        $dead_line = strtotime($userTasks['Task']['dead_line']);
        $datediff =  floor(($dead_line - $now)/(60*60*24));
//        print_r($taskComments); die;
        $this->set(compact('userTasks', 'datediff', 'taskComments'));
    }



}
