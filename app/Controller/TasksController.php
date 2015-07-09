<?php

App::uses('AppController', 'Controller');


class TasksController extends AppController {

    public $name = 'Tasks';
<<<<<<< HEAD

    public $uses = array('Task','Lawsuit', 'TaskComment', 'Client','User', 'Follower');

=======
    
    public $uses = array('Task','Lawsuit','Client','User', 'Follower','Activity');

>>>>>>> beta
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
<<<<<<< HEAD


=======
    
    
>>>>>>> beta
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
<<<<<<< HEAD

=======
    
>>>>>>> beta
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
<<<<<<< HEAD


=======
    
    
>>>>>>> beta
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


    public function details($id){
        $this->Task->unbindModel(
            array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
        );
        $options = array(
            'conditions' => array('Task.assigned_to' => Authsome::get("id"), 'Task.id' => $id),
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






<<<<<<< HEAD

//    public function index(){
//        extract($this->params["named"]);
//
=======
//    public function index(){
//        extract($this->params["named"]);
//        
>>>>>>> beta
//        if(isset($search)){
//            $options["Category.title like"]="%$search%";
//        }
//        else $search="";
<<<<<<< HEAD
//
//        $this->paginate["Category"]["order"]="Category.created DESC";
//
=======
//        
//        $this->paginate["Category"]["order"]="Category.created DESC";
//        
>>>>>>> beta
//        $categories = $this->paginate('Category', $options);
//        $count = count($categories);
//        $itemEachRow = $count / 3;
//        //pr($categories);
//        $this->set(compact('categories','search', 'itemEachRow'));
//    }
<<<<<<< HEAD

=======
    
>>>>>>> beta
    public function delete($id) {
        if($id == null){
            throw new BadRequestException();
        }
    }


    public function test(){
        throw new BadRequestException();
    }
<<<<<<< HEAD

=======
    
>>>>>>> beta
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
