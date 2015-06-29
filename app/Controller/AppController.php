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
        'DebugKit.Toolbar',
        'Authsome.Authsome' => array(
            'model' => 'User',
        ),
        'Qimage',
        'Sanction.Permit' => array(
            'path' => 'User',
            'check' => 'User.group'
        )
    );
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Time',
        'Cache',
        'Text',
        'Paginator',
        'Tinymce'
//        'Recaptcha.Recaptcha',
//        'Sidemenu'
    );
    public $theme = 'Lawfirm';

    public function beforeFilter() {
        //pr($this->params); die;
        $this->layout = 'admin';
        $current_url = Router::url(null);
        $current_url_array = explode('/', $current_url);
        //if(Router::url(null)!='/login' && Router::url(null)!='/logout')
        if (!in_array('login', $current_url_array) && !in_array('logout', $current_url_array)) {
            $this->Session->write('redirect_url', Router::url(null, true));
        }

        if (isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
            if (Authsome::get("group") != 'admin' && Authsome::get("group") != 'manager') {
                $this->Session->setFlash('<div class="alert alert-danger">' . __('You must be an administrator to access this resource.') . '</div>');
                $this->redirect('/login');
            }
            $loggedin = Authsome::get("name");
            $this->set(compact('loggedin'));
            $this->layout = 'admin';
        } elseif (isset($this->request->params['customer']) && ($this->request->params['prefix'] == 'customer')) {
            if ($this->Session->check('Auth.User')) {
                $this->set('authUser', $this->Auth->user());
                $loggedin = $this->Session->read('Auth.User');
                $this->set(compact('loggedin'));
                $this->layout = 'customer';
            }
        } else {
            // $this->Auth->allow();
        }
    }

}
