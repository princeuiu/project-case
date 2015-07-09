<?php

App::uses('AppController', 'Controller');


class TaskCommentsController extends AppController {

    public $name = 'TaskComments';
    
    public $uses = array('TaskComment');

    public function add(){
        if(empty($this->data)){
            throw new BadRequestException();
        }
        //print_r($this->data); die;

        $taskId = $this->data['TaskComment']['task_id'];

        if($this->TaskComment->save($this->data)){

            return $this->redirect(array('controller' => 'tasks', 'action' => 'details', $taskId));
        }

    }


}
