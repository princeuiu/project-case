<?php

App::uses('AppController', 'Controller');


class TasksController extends AppController {

    public $name = 'Tasks';
    
    public $uses = array('Task','Lawsuit','Client','User', 'Follower');

    public function admin_add(){
        if(!empty($this->data)){
            $data = $this->data;
            //print_r($data); die;
            $splitTime  = explode('/', $data['Task']['dead_line']);
            $data['Task']['dead_line'] = $splitTime[2] . '-' . $splitTime[0] . '-' . $splitTime[1];
            $followers = $data['Task']['follower'];
            unset($data['Task']['follower']);
            if($this->Task->save($data)){
                $taskId = $this->Task->id;
                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task added successfully.') . '</div>');
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
    
    
    public function admin_edit($id) {
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
                if(!empty($followers)){
                    $this->Task->saveFowllers($taskId, $followers);
                }
                else{
                    $this->Task->removeFowllers($taskId);
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task Updated successfully.') . '</div>');
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
    
    public function admin_index() {
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
    
    
    public function admin_list(){
        $options = array(
            'conditions' => array('Task.assigned_to' => Authsome::get("id"), 'Task.status' => 'pending'), 
            'order' => array('Task.dead_line DESC')
        );
        $userTasks = $this->Task->find('all', $options);
        print_r($userTasks); die;
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
    
    
    public function test(){
        throw new BadRequestException();
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
