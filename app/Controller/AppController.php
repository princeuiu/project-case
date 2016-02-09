<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Cookie',
        'RequestHandler',
        'Email',
        'Paginator',
//        'Recaptcha.Recaptcha',
        'DebugKit.Toolbar' => array(
            'panels' => array(
                'Sanction.Permit'
            )
        ),
        'Authsome.Authsome' => array(
            'model' => 'User',
            'configureKey' => 'UserAuth',
            'sessionKey' => 'UserAuth',
            'cookieKey' => 'UserAuth',
        ),
        'Sanction.Permit' => array(
            'path' => 'UserAuth'
        ),
        'Qimage',
    );
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Time',
        'Cache',
        'Text',
        'Paginator',
        'Notify'
//        'Recaptcha.Recaptcha',
//        'Sidemenu'
    );
    public $theme = 'Lawfirm';
    //public $uses = array('Country','Bug','User');

    //public $allowed_pages = array('checkpoint','ajax_usermenu','login_api','logout');
    
    public $admins=array('manager','admin');
    
    public $superadmins=array('admin');

    function beforeFilter() {
        $this->layout = 'admin';
        $current_url = Router::url(null);
        $current_url_array = explode('/', $current_url);
        //if(Router::url(null)!='/login' && Router::url(null)!='/logout')
        if (!in_array('login', $current_url_array) && !in_array('logout', $current_url_array)) {
            $this->Session->write('redirect_url', Router::url(null, true));
        }
        // reset session manually
        if (isset($this->params['url'][Configure::read('Session.cookie')])) {
            $this->Session->id($this->params['url'][Configure::read('Session.cookie')]);
            //echo $this->params['url'][Configure::read('Session.cookie')];
        }

        $this->set('admins', $this->admins);
        $this->set('superadmins', $this->superadmins);


        if (isset($this->params['ajax']) && $this->params['ajax'] == 1):
            $this->layout = 'ajax';
        endif;

        // Get logged in user's information
        $user = Authsome::get();
        $loggedinId = Authsome::get("id");
        $loggedin = Authsome::get("name");
        $this->set(compact('user','loggedin', 'loggedinId'));

        


        /* SMTP Options */

        /* Set delivery method */
        //$this->Email->delivery = 'smtp';

        // default sending email address
        //$this->Email->from = 'G&R Ad Network <noreply@gandr.com.bd>';
        // mailer info
        //$this->Email->xMailer = "G&R Email Component";

        // email component setup
//        $this->Email->smtpOptions = array(
//            'timeout' => '5',
//            'host' => 'ssl://in-v3.mailjet.com',
//            'port' => '465',
//            'username' => '97870a474bce6dd43cd20d747f770d9f',
//            'password' => '641bf96de4006a42df2ad7c40c558cba'
//        );
    }
    
    public function check_access($groups = array()){
        $user = Authsome::get();
        if(!empty($user) && in_array(Authsome::get('role'), $groups)){
            return true;
        }
        else{
            $this->Session->setFlash('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . __('You don\'t have access to view this resource, Please Login.') . '</div>');
            return $this->redirect('/login');
        }
    }

//    public function beforeFilter() {
//        //pr($this->params); die;
//        $this->layout = 'admin';
//        $current_url = Router::url(null);
//        $current_url_array = explode('/', $current_url);
//        //if(Router::url(null)!='/login' && Router::url(null)!='/logout')
//        if (!in_array('login', $current_url_array) && !in_array('logout', $current_url_array)) {
//            $this->Session->write('redirect_url', Router::url(null, true));
//        }
//
//        if (isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
//            if (Authsome::get("group") != 'admin' && Authsome::get("group") != 'manager' && Authsome::get("group") != 'employee' && Authsome::get("group") != 'viewer') {
//                $this->Session->setFlash('<div class="alert alert-danger">' . __('You must be an administrator to access this resource.') . '</div>');
//                $this->redirect('/login');
//            }
//            $loggedinId = Authsome::get("id");
//            $loggedin = Authsome::get("name");
//            $this->set(compact('loggedin', 'loggedinId'));
//            $this->layout = 'admin';
//        } elseif (isset($this->request->params['customer']) && ($this->request->params['prefix'] == 'customer')) {
//            if ($this->Session->check('Auth.User')) {
//                $this->set('authUser', $this->Auth->user());
//                $loggedin = $this->Session->read('Auth.User');
//                $this->set(compact('loggedin'));
//                $this->layout = 'customer';
//            }
//        } else {
//            // $this->Auth->allow();
//        }
//    }

}
