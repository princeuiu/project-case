<?php

App::uses('AppController', 'Controller');


class TaskCommentsController extends AppController {

    public $name = 'TaskComments';

    public $uses = array('TaskComment', 'Task', 'WantingDoc');

    public function add(){
        $this->check_access(array('employee', 'manager','admin'));

        if(empty($this->data)){
            throw new BadRequestException();
        }
//        print_r($this->data);die;
        $taskId = $this->data['TaskComment']['task_id'];
        if($this->TaskComment->save($this->data)){
            $path = WWW_ROOT . 'uploads' . DS . 'doc' . DS;
            $commentId =$this->TaskComment->id;
            $files = $this->data['TaskComments']['files'];
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
            //die;

            return $this->redirect(array('controller' => 'tasks', 'action' => 'details', $taskId));
        }

    }


}
