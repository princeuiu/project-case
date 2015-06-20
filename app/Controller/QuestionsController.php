<?php

App::uses('AppController', 'Controller');


class QuestionsController extends AppController {

    public $name = 'Questions';

    public function admin_add(){
        if(!empty($this->data)){
            if($this->Question->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Question added successfully.') . '</div>');
                return $this->redirect(array('controller' => 'Questions', 'action' => 'edit', $this->Question->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Question now, Please try again later.') . '</div>');
                return;
            }
        }
    }
    
    public function admin_edit($id) {
        if($id == null){
            throw new BadRequestException();
        }
        $this->Question->id = $id;
        if(!empty($this->data)){
            if($this->Question->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Question updated successfully.') . '</div>');
                return $this->redirect(array('controller' => 'Questions', 'action' => 'edit', $this->Question->id));
            }
            else{
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t save Question now, Please try again later.') . '</div>');
                return $this->redirect(array('controller' => 'Questions', 'action' => 'edit', $this->Question->id));
            }
        }

        $this->data = $this->Question->read();

        
        $this->render('admin_add');
    }
    
    public function admin_index() {
        extract($this->params["named"]);
        
        if(isset($search)){
            $options["Question.question like"]="%$search%";
        }
        else $search="";
        
        $this->paginate["Question"]["order"]="Question.created DESC";
        
        $questions = $this->paginate('Question', $options);
        //pr($questions);
        $this->set(compact('questions','search'));
        
        
        //$this->set("search",$search);
    }
    
    public function admin_delete($id) {
        if($id == null){
            throw new BadRequestException();
        }
        if($this->Question->delete($id)){
            $this->Session->setFlash('<div class="alert alert-success">' . __('Question deleted successfully.') . '</div>');
            return $this->redirect(array('controller' => 'Questions', 'action' => 'index', 'admin'=>true));
        }
        else{
            $this->Session->setFlash('<div class="alert alert-danger">' . __('Can\'t delete Question now, Please try again later.') . '</div>');
            return $this->redirect(array('controller' => 'Questions', 'action' => 'index', 'admin'=>true));
        }
        
    }

}
