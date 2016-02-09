<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {

	public $name = 'Users';

    public function login() {
        $this->layout = 'login';
        if (empty($this->data)) {
            $this->sidebar = false;
            $this->commonBanner = false;
                return;
        }
            //print_r($this->data); die;
        $user = Authsome::login($this->data['User']);


        if (!$user) {
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Invalid login. Please, try again.') . '</div>');
                return;
        }

        $remember = (!empty($this->data['User']['remember']));
        if ($remember) {
                Authsome::persist('2 weeks');
        }
        $redirect_url = $this->Session->read('redirect_url');

        if(!empty($redirect_url)){
            $this->redirect($this->Permit->referer($redirect_url));
        }
        else{
            $this->redirect($this->Permit->referer('/admin'));
        }
    }
    
    
    
    
    public function admin_login() {
        $this->layout = 'login';
        $this->render('login');
        if (empty($this->data)) {
            $this->sidebar = false;
            $this->commonBanner = false;
                return;
        }
            //print_r($this->data); die;
        $user = Authsome::login($this->data['User']);


        if (!$user) {
                $this->Session->setFlash('<div class="alert alert-danger">' . __('Invalid login. Please, try again.') . '</div>');
                return;
        }

        $remember = (!empty($this->data['User']['remember']));
        if ($remember) {
                Authsome::persist('2 weeks');
        }
        $redirect_url = $this->Session->read('redirect_url');

        if(!empty($redirect_url)){
            $this->redirect($this->Permit->referer($redirect_url));
        }
        else{
            $this->redirect($this->Permit->referer('/admin'));
        }
        
    }
    
    
    
    
    
    

    public function ajax_login(){
        $data = $_POST['data'];
        $user = Authsome::login($data);

        if (!$user) {
                Echo 'error';
                exit;
        }

        if(isset($data['remember'])){
            $remember = $data['remember'];
            if ($remember) {
                    Authsome::persist('2 weeks');
            }
        }
        
        Echo 'success';
        exit;
        // $redirect_url = $this->Session->read('redirect_url');
        // $this->Session->setFlash('Login Successfull.');
        // $this->redirect($redirect_url);

    }
    
    public function logout(){
        Authsome::logout();
        $this->redirect('/login');
        
    }

    public function register(){
        //$this->layout = 'admin';
        if (!empty($this->data)) {
            if($this->User->save($this->data)){
                $this->Session->setFlash('<div class="alert alert-success">' . __('Your account has been created.') . '</div>');
                return $this->redirect(array('controller' => 'users', 'action' => 'all'));
            }
        }
        return;
    }

    public function all(){
        extract($this->params["named"]);

//        if(isset($search)){
//            $options["User.name like"]="%$search%";
//        }
//        else $search="";

        $this->paginate["User"]["order"]="User.name DESC";

        $items = $this->User->find('all');


//        print_r($items);die;
        $this->set(compact('items','search'));

    }

    public function details($id){
        extract($this->params["named"]);

//        if(isset($search)){
//            $options["User.name like"]="%$search%";
//        }
//        else $search="";

        $this->paginate["User"]["order"]="User.name DESC";

        $items = $this->User->find('first', array(
            'conditions' => array('User.id' => $id)
        ));


//        print_r($items);die;
        $this->set(compact('items','search'));

    }

    public function ajax_register(){
        $data = $_POST['data'];
        if (!empty($data)) {
            if($this->User->save($data)){
                $loginData = array(
                    'User' => array(
                        'email' => $data['User']['email'],
                        'password' => $data['User']['password'],
                        'remember' => 0
                        )
                    );
                $user = Authsome::login($loginData['User']);
                Echo 'success';
                exit;
            }
        }
        Echo 'error';
        exit;
    }

}
