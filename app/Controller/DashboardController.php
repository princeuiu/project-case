<?php

App::uses('AppController', 'Controller');


class DashboardController extends AppController {

    public $name = 'Dashboard';
    public $uses = array('History', 'Lawsuit', 'Client', 'Activity', 'Task');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index(){
        $logged_in_user_id = Authsome::get("id");
        $activity_data = $this->Activity->find('all',array(
            'conditions' => array('Activity.user_id' => $logged_in_user_id),
            'order' => array('Activity.created DESC')
        ));

        $assigned_tasks = $this->Task->find('all',array(
            'conditions' => array('Task.assigned_to' => $logged_in_user_id),
            'order' => array('Task.dead_line ASC')
        ));

        $new_lawsuits = $this->Lawsuit->find('all', array(
            'conditions' => array('Lawsuit.number' => ''),
            'order' => array('Lawsuit.created ASC')
        ));
        $dateTo = date('Y-m-d H:i:s',mktime(0, 0, 0, date("m"), date("d")+3,   date("Y")));
        $dateFrom = date('Y-m-d H:i:s',mktime(0, 0, 0, date("m"), date("d"),   date("Y")));
        //$today =now();
//        echo $dateFrom; die;
        $new_histories = $this->History->find('all',array(
            'conditions' => array('History.reporting_date >= ' => $dateFrom, 'History.reporting_date < ' => $dateTo),
            'order' => array('History.reporting_date ASC')
        ));



//        print_r($new_histories);die;
        $this->set(compact('assigned_tasks', 'new_lawsuits', 'new_histories'));
    }








}
