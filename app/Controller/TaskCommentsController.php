<?php

App::uses('AppController', 'Controller');


class TaskCommentsController extends AppController {

    public $name = 'TaskComments';

    public $uses = array('TaskComment', 'Task', 'WantingDoc','Activity');

    public function add(){
        $this->check_access(array('employee', 'manager','admin'));

        if(empty($this->data)){
            throw new BadRequestException();
        }
        //print_r($this->data);die;
        $taskId = $this->data['TaskComment']['task_id'];
        $userId = $this->data['TaskComment']['user_id'];
        if(isset($this->data['TaskComments']['done']) && $this->data['TaskComments']['done'] == true){
            $isTaskDone = $this->data['TaskComments']['done'];
        }
        else{
            $isTaskDone = false;
        }
        if($this->TaskComment->save($this->data)){
            $Activity = ClassRegistry::init('Activity');
            $Activity->logintry("taskcomment","new",$this->TaskComment->id,$userId,$taskId,'');
            $path = WWW_ROOT . 'uploads' . DS . 'doc' . DS;
            $commentId =$this->TaskComment->id;
            $files = $this->data['TaskComments']['files'];
            $fileCount = count($files);
            if($fileCount == 0){
                $isTaskDone = false;
            }
            $i = 0;
            $uploadSuccessfull = true;
            while($i < count($files)){
                if ($files[$i]['error'] == 0){
                    $fileData = array(
                        'WantingDoc' => array(
                            'task_id' => $taskId,
                            'comment_id' => $commentId,
                            'name' => 't' . $taskId . 'c' . $commentId . $files[$i]['name'],
                            'path' => $path,
                            'done' => $isTaskDone
                        )
                    );
                    //print_r($fileData);
                    $this->WantingDoc->create();
                    if($this->WantingDoc->save($fileData)) {
                        if (move_uploaded_file($files[$i]['tmp_name'], ($path.'t' . $taskId . 'c' . $commentId . $files[$i]['name']))) {
                        } else {
                            $uploadSuccessfull = false;
                            //echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    unset($fileData);
                }


                $i = $i + 1;
            }
            
            if($uploadSuccessfull){
                if($isTaskDone){
                    $this->Task->id =  $taskId;
                    $this->Task->saveField('status', 'done');
                }
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'details', $taskId));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Updated failed! Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'tasks', 'action' => 'details', $taskId));
            }
            //die;
        }
        else{
            $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Please give a comment.') . '</div>');
            return $this->redirect(array('controller' => 'tasks', 'action' => 'details', $taskId));
        }

    }


}
