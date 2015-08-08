<?php
App::uses('AppHelper', 'View/Helper');

class NotifyHelper extends AppHelper {

    public $helpers = array('Html', 'Text', 'Time');
    private $countTasks = 0;
    private $allTasks = array();
    private $userTaskList = array();
    private $countNotifications = 0;
    private $allNotifications = array();
    private $userID;
    private $role;

    public function renderNotification() {
        ?>
        <li class="dropdown hidden-phone">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-bell"></i>
                <?php if ($this->countNotifications > 0): ?>
                    <span class="badge red"> <?php
                        if ($this->countNotifications < 100) {
                            echo $this->countNotifications;
                        } else {
                            echo '99+';
                        }
                        ?> </span>
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu notifications">
                <li class="dropdown-menu-title">
                    <span>You have <?php echo $this->countNotifications; ?> notifications</span>
        <!--                    <a href="#refresh"><i class="icon-repeat"></i></a>-->
                </li>	
                <?php foreach ($this->allNotifications as $notification): ?>
                    <li>
                        <a href="<?php
                            switch($notification['Activity']['item_type']){
                                case 'task':
                                    echo $this->Html->url(array('controller' => 'tasks', 'action' => 'details', $notification['Activity']['item_id']));
                                    break;
                            }
                            
                        ?>">
                            <span class="icon <?php if($notification['Activity']['event'] == 'new'){ echo 'blue';} elseif($notification['Activity']['event'] == 'update'){ echo 'yellow';} ?>"><i class="icon-tasks"></i></span>
                            <span class="message">
                                <?php
                                    switch($notification['Activity']['item_type']){
                                        case 'task':
                                            echo substr($this->userTaskList[$notification['Activity']['item_id']], 0, 20);
                                            break;
                                    }
                                ?>
                            </span>
                            <span class="time"><?php echo $this->Time->format($notification['Activity']['created'], '%B %e, %Y'); ?></span> 
                        </a>
                    </li>
                <?php endforeach; ?>

                <li class="dropdown-menu-sub-footer">
                    <a>View all notifications</a>
                </li>	
            </ul>
        </li>
        <?php
    }

    public function renderTasks() {
        ?>
        <li class="dropdown hidden-phone">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-calendar"></i>
                <?php if ($this->countTasks > 0): ?>
                    <span class="badge red"> <?php
                        if ($this->countTasks < 100) {
                            echo $this->countTasks;
                        } else {
                            echo '99+';
                        }
                        ?> </span>
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu tasks">
                <li class="dropdown-menu-title">
                    <span>You have <?php echo $this->countTasks; ?> tasks in progress</span>
<!--                    <a href="#refresh"><i class="icon-repeat"></i></a>-->
                </li>
                <?php foreach($this->allTasks as $task): ?>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'details', $task['Task']['id'])); ?>">
                        <span class="header">
                            <span class="title"><?php echo $task['Task']['name']; ?></span>
                            <span class="title"><?php echo $task['Task']['datediff']; ?> day(s)</span>
                        </span>
                    </a>
                </li>
                <?php endforeach; ?>
                <li>
                    <a class="dropdown-menu-sub-footer">View all tasks</a>
                </li>	
            </ul>
        </li>




        <?php
    }

    public function initialize() {
        // initialization
        $this->userID = Authsome::get("id");
        $this->role = Authsome::get("role");
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
            
            App::import("Model", "Client");
            App::import("Model", "History");
            App::import("Model", "Invoice");
            App::import("Model", "Lawsuit");
            App::import("Model", "TaskComment");
            App::import("Model", "User");
            
            $history = new History();
            $invoice = new Invoice();
            $lawsuit = new Lawsuit();
            $taskComment = new TaskComment();
            $user = new User();
            
            
            $tasks = $task->find('list',array('conditions' => array('Task.assigned_to' => $this->userID),'fields'=>array('id','name')));
            $this->userTaskList = $tasks;
            $taskComments = $taskComment->find('list',array('conditions' => array('TaskComment.user_id' => $this->userID),'fields'=>array('id','task_id')));
            
            if(!empty($tasks)){
                $taskList = array();
                foreach($tasks AS $taskId => $taskName){
                    $taskList[] = $taskId;
                }
                $cond[] = 'Activity.item_type  = "task" AND Activity.item_id in ('.implode(',',$taskList).')';
            }
            
            
            if(empty($cond)){
                $cond[] = '0';
            }
            $options = array(
                        'conditions' => array(
                            'OR' => $cond,
                            'Activity.viewed' => false
                                        )
                );
            
            $userActivities = $activity->find('all', $options);
            //print_r($userActivities); die;
            $this->allNotifications = $userActivities;

//            $activityOptions = array(
//                'conditions' => array('Activity.reference_id' => $this->userID, 'Activity.viewed' => 0),
//                'order' => array('Activity.created DESC')
//            );
//            $userActivities = $activity->find('all', $activityOptions);

            $this->allNotifications = $userActivities;
            $this->countNotifications = count($userActivities);
        }
    }

}
?>