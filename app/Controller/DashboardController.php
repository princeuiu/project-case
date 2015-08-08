<?php

App::uses('AppController', 'Controller');


class DashboardController extends AppController {

    public $name = 'Dashboard';
    public $uses = array('History', 'Lawsuit', 'Client', 'Activity');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index(){
        $logged_in_user_id = Authsome::get("id");
        $activity_data = $this->Activity->find('all',array(
            'conditions' => array('Activity.user_id' => $logged_in_user_id),
            'order' => array('Activity.created DESC')
        ));
        print_r($activity_data);die;
    }







}
