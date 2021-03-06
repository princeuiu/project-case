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
        $commentData = array(
            'TaskComment' => $this->data['TaskComment']
        );
        if(!isset($this->data['TaskComment']['body'])){
            $commentData['TaskComment']['body'] = 'No comment';
        }
//        print_r($commentData);die;
        $taskId = $this->data['TaskComment']['task_id'];
        $taskOwner = $this->data['TaskComments']['task_owner'];
        $taskAssigned = $this->data['TaskComments']['task_assigned'];
        $userId = $this->data['TaskComment']['user_id'];
        $lawsuitType = $this->data['Lawsuit']['type'];
        $lawsuitId = $this->data['Lawsuit']['id'];
        if(isset($this->data['TaskComments']['done']) && $this->data['TaskComments']['done'] == true){
            $isTaskDone = $this->data['TaskComments']['done'];
        }
        else{
            $isTaskDone = false;
        }
        if($this->TaskComment->save($commentData)){
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
                    $Activity = ClassRegistry::init('Activity');
                    $Activity->logintry("task","done",$taskId,$taskOwner,$taskAssigned,'');
                    if($lawsuitType == 'landvetting'){
                        $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Task done. Please generate Invoice.') . '</div>');
                        return $this->redirect(array('controller' => 'invoices', 'action' => 'generate', $lawsuitId));
                    }
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
    
    
    public function add_office_file(){
//        print_r($this->data); die;
        $path = WWW_ROOT . 'uploads' . DS . 'doc' . DS;
        $commentId = 0;
        $lawsuitId = $this->data['TaskComments']['lawsuit_id'];
        $taskId = $this->data['TaskComments']['task_id'];
        $files = $this->data['TaskComments']['files'];
        if ($files['error'] == 0){
            $fileData = array(
                'WantingDoc' => array(
                    'task_id' => $taskId,
                    'comment_id' => $commentId,
                    'name' => 't' . $taskId . 'c' . $commentId . $files['name'],
                    'path' => $path,
                    'office_copy' => true
                )
            );
            //print_r($fileData);
            $this->WantingDoc->create();
            if($this->WantingDoc->save($fileData)) {
                if (move_uploaded_file($files['tmp_name'], ($path.'t' . $taskId . 'c' . $commentId . $files['name']))) {
                    $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Office copy uploaded successfully.') . '</div>');
                    return $this->redirect(array('controller' => 'lawsuits', 'action' => 'details', $lawsuitId));
                } else {
                    $this->Session->setFlash('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . __('Can\'t upload Office copy now. Please try again later.') . '</div>');
                    return $this->redirect(array('controller' => 'lawsuits', 'action' => 'details', $lawsuitId));
                }
            }
        }
    }


}
