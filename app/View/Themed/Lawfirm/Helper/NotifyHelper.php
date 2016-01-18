<?php
App::uses('AppHelper', 'View/Helper');

class NotifyHelper extends AppHelper {

    var $helpers = array('Html', 'Text');
    private $count = 0;
    private $countTasks = 0;
    private $allTasks = array();
    private $countNotifications = 0;
    private $allNotifications = array();
    private $userID;
    private $role;

    public function renderNotification() {
        ?>
        <li class="dropdown hidden-phone">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-bell"></i>
                <?php if($this->countNotifications > 0): ?>
                <span class="badge red"> <?php if($this->countNotifications < 100){ echo $this->countNotifications; } else{ echo '99+'; } ?> </span>
                <?php endif; ?>
            </a>
            
                <li class="dropdown-menu-title">
                    <span>You have <?php echo $this->countNotifications; ?> notifications</span>
<!--                    <a href="#refresh"><i class="icon-repeat"></i></a>-->
                </li>
                <?php foreach($this->allNotifications as $notification): ?>
                <li>
                    <a href="#">
                        <span class="icon blue"><i class="icon-tasks"></i></span>
                        <span class="message">New user registration</span>
                        <span class="time">1 min</span> 
                    </a>
                </li>
                <?php endforeach; ?>
                <li>
                    <a href="#">
                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                        <span class="message">New comment</span>
                        <span class="time">7 min</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                        <span class="message">New comment</span>
                        <span class="time">8 min</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                        <span class="message">New comment</span>
                        <span class="time">16 min</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon blue"><i class="icon-user"></i></span>
                        <span class="message">New user registration</span>
                        <span class="time">36 min</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon yellow"><i class="icon-shopping-cart"></i></span>
                        <span class="message">2 items sold</span>
                        <span class="time">1 hour</span> 
                    </a>
                </li>
                <li class="warning">
                    <a href="#">
                        <span class="icon red"><i class="icon-user"></i></span>
                        <span class="message">User deleted account</span>
                        <span class="time">2 hour</span> 
                    </a>
                </li>
                <li class="warning">
                    <a href="#">
                        <span class="icon red"><i class="icon-shopping-cart"></i></span>
                        <span class="message">New comment</span>
                        <span class="time">6 hour</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon green"><i class="icon-comment-alt"></i></span>
                        <span class="message">New comment</span>
                        <span class="time">yesterday</span> 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon blue"><i class="icon-user"></i></span>
                        <span class="message">New user registration</span>
                        <span class="time">yesterday</span> 
                    </a>
                </li>
                <li class="dropdown-menu-sub-footer">
                    <a>View all notifications</a>
                </li>	
            
        </li>
        <?php
    }

    public function renderTasks() {
        
    }

    

    function init() {
        // initialization
        $this->userID = Authsome::get("id");
        $this->group = Authsome::get("role");
        $this->__count_all_notifications();
    }

    private function __count_all_notifications() {
        App::import("Model", "Activity");
        $activity = new Activity();

        if ($this->role == 'employee') {
            App::import("Model", "Task");
            $task = new Task();

            $task->unbindModel(
                    array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
            );
            $options = array(
                'conditions' => array('Task.assigned_to' => $this->userID, 'Task.status' => 'pending'),
                'order' => array('Task.dead_line ASC'),
                'fields' => array('Task.id', 'Task.name', 'Task.slug', 'Task.dead_line', 'Lawsuit.number')
            );
            $userTasks = $task->find('all', $options);

            $tasks = array();

            $now = time();
            $count = 0;
            foreach ($userTasks as $userTask) {
                $dead_line = strtotime($userTask['Task']['dead_line']);
                $datediff = $dead_line - $now;
                $tasks[$count] = $userTask;
                $tasks[$count]['Task']['datediff'] = floor($datediff / (60 * 60 * 24));
                $count++;
            }

            $this->allTasks = $tasks;
            $this->countTasks = count($tasks);

            $activityOptions = array(
                'conditions' => array('Activity.reference_id' => $this->userID, 'Activity.viewed' => 0),
                'order' => array('Activity.created DESC')
            );
            $userActivities = $activity->find('all', $activityOptions);
            print_r($userActivities); die;

            $this->allNotifications = $userActivities;
            $this->countNotifications = count($userActivities);
        }
    }

}
?>