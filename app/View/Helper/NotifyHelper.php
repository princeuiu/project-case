<?php
App::uses('AppHelper', 'View/Helper');

class NotifyHelper extends AppHelper {

    public $helpers = array('Html', 'Text', 'Time');
    private $countTasks = 0;
    private $allTasks = array();
    private $tasklistName = array();
    private $userTaskList = array();
    private $userTaskCommentList = array();
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
                                case 'taskcomment':
                                    echo $this->Html->url(array('controller' => 'tasks', 'action' => 'details', $notification['Activity']['reference_id']));
                                    break;
                                case 'lawsuit':
                                    echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'details', $notification['Activity']['item_id']));
                                    break;
                                case 'invoice':
                                    echo $this->Html->url(array('controller' => 'invoices', 'action' => 'generate', $notification['Activity']['reference_id']));
                                    break;
                            }
                            
                        ?>">
                            <span class="icon <?php if($notification['Activity']['event'] == 'new'){ echo 'blue';} elseif($notification['Activity']['event'] == 'update'){ echo 'yellow';} elseif($notification['Activity']['event'] == 'done'){ echo 'green';}  elseif($notification['Activity']['event'] == 'generate'){ echo 'red';} ?>">
                                <i class="<?php
                                            switch($notification['Activity']['item_type']){
                                                case 'task':
                                                    echo 'icon-tasks';
                                                    break;
                                                case 'taskcomment':
                                                    echo 'icon-comment-alt';
                                                    break;
                                                case 'lawsuit':
                                                    echo 'icon-book';
                                                    break;
                                                case 'invoice':
                                                    echo 'icon-money';
                                                    break;
                                            }
                                            ?>">
                                </i>
                            </span>
                            <span class="message">
                                <?php
                                    switch($notification['Activity']['item_type']){
                                        case 'task':
                                            ?>
                                <small><?php echo $notification['Activity']['event'] . ' '; ?></small>
                                            <?php
                                            echo substr($this->tasklistName[$this->userTaskList[$notification['Activity']['item_id']]], 0, 15);
                                            break;
                                        case 'taskcomment':
                                            echo substr($this->userTaskCommentList[$notification['Activity']['item_id']], 0, 20);
                                            break;
                                        case 'lawsuit':
                                            echo 'New file opened.';
                                            break;
                                        case 'invoice':
                                            echo 'Generate invoice.';
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
                            <span class="title"><?php echo $task['Tasklist']['name']; ?></span><br/>
                            <span class="title"><?php echo $task['Task']['datedifftxt']; ?></span>
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
                //'fields' => array('Task.id', 'Tasklist.name', 'Tasklist.slug', 'Task.dead_line', 'Lawsuit.number')
                'fields' => array('Task.id', 'Tasklist.name', 'Tasklist.slug', 'Task.dead_line', 'Lawsuit.number')
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
                if($tasks[$count]['Task']['datediff'] < 0){
                    $tasks[$count]['Task']['datedifftxt'] = $tasks[$count]['Task']['datediff'] * (-1);
                    $tasks[$count]['Task']['datedifftxt'] = '<span style="color:red;">'.$tasks[$count]['Task']['datedifftxt'].' day(s) over<span>';
                }
                else{
                    $tasks[$count]['Task']['datedifftxt'] = '<span>'.$tasks[$count]['Task']['datediff'].' day(s) left<span>';
                }
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
            App::import("Model", "Tasklist");
            
            $history = new History();
            $invoice = new Invoice();
            $lawsuit = new Lawsuit();
            $taskComment = new TaskComment();
            $user = new User();
            $tasklist = new Tasklist();
            
            $tasklistName = $tasklist->find('list',array('conditions' => array('Tasklist.status' => 'active'),'fields'=>array('Tasklist.id','Tasklist.name')));
            $this->tasklistName = $tasklistName;
            
            $tasks = $task->find('list',array('conditions' => array('Task.assigned_to' => $this->userID),'fields'=>array('Task.id','Task.tasklist_id')));
            $this->userTaskList = $tasks;
            //$taskComments = $taskComment->find('list',array('conditions' => array('TaskComment.task_id' => $this->userID),'fields'=>array('id','task_id')));
            
            if(!empty($tasks)){
                $taskList = array();
                foreach($tasks AS $taskId => $taskName){
                    $taskList[] = $taskId;
                }
                $cond[] = 'Activity.item_type  = "task" AND Activity.item_id in ('.implode(',',$taskList).')';
                
                $taskComments = $taskComment->find('list',array('conditions' => array('TaskComment.task_id' => $taskList),'fields'=>array('id','body')));
                $this->userTaskCommentList = $taskComments;
                if(!empty($taskComments)){
                    $taskCommentsList = array();
                    foreach($taskComments AS $taskCommentId => $taskCommentBody){
                        $taskCommentsList[] = $taskCommentId;
                    }
                    if(!empty($taskCommentsList)){
                        $cond[] = 'Activity.item_type  = "taskcomment" AND Activity.item_id in ('.implode(',',$taskCommentsList).')';
                    }
                }
            }
            
            
            if(empty($cond)){
                $cond[] = '0';
            }
            $dateFrom = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d')-3, date('Y')));
            $options = array(
                        'conditions' => array(
                            'OR' => $cond,
                            'Activity.viewed' => false,
                            'Activity.created >=' => $dateFrom
                                        )
                );
            
            $userActivities = $activity->find('all', $options);
            //print_r($userActivities); die;
            $this->allNotifications = $userActivities;

            $this->allNotifications = $userActivities;
            $this->countNotifications = count($userActivities);
        }
        elseif($this->role == 'admin' || $this->role == 'manager'){
            
            App::import("Model", "Task");
            $task = new Task();

            $task->unbindModel(
                    array('belongsTo' => array('Owner', 'Assigned'), 'hasAndBelongsToMany' => array('FollowerUser'))
            );
            $options = array(
                'conditions' => array('Task.assigned_to' => $this->userID, 'Task.status' => 'pending'),
                'order' => array('Task.dead_line ASC'),
                //'fields' => array('Task.id', 'Tasklist.name', 'Tasklist.slug', 'Task.dead_line', 'Lawsuit.number')
                'fields' => array('Task.id', 'Tasklist.name', 'Tasklist.slug', 'Task.dead_line', 'Lawsuit.number')
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
                if($tasks[$count]['Task']['datediff'] < 0){
                    $tasks[$count]['Task']['datedifftxt'] = $tasks[$count]['Task']['datediff'] * (-1);
                    $tasks[$count]['Task']['datedifftxt'] = '<span style="color:red;">'.$tasks[$count]['Task']['datedifftxt'].' day(s) over<span>';
                }
                else{
                    $tasks[$count]['Task']['datedifftxt'] = '<span>'.$tasks[$count]['Task']['datediff'].' day(s) left<span>';
                }
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
            App::import("Model", "Tasklist");
            
            $history = new History();
            $invoice = new Invoice();
            $lawsuit = new Lawsuit();
            $taskComment = new TaskComment();
            $user = new User();
            $tasklist = new Tasklist();
            
            $tasklistName = $tasklist->find('list',array('conditions' => array('Tasklist.status' => 'active'),'fields'=>array('Tasklist.id','Tasklist.name')));
            $this->tasklistName = $tasklistName;
            
            
//            $tasks = $task->find('list',array('conditions' => array('Task.assigned_to' => $this->userID),'fields'=>array('Task.id')));
            $taskQueryCond = array(
                'Task.assigned_to = "'.$this->userID.'"',
                'Task.owner = "'.$this->userID.'"'
            );
            $tasks = $task->find('list',array('conditions' => array('OR' => $taskQueryCond),'fields'=>array('Task.id','Task.tasklist_id')));
            $this->userTaskList = $tasks;
            //$taskComments = $taskComment->find('list',array('conditions' => array('TaskComment.task_id' => $this->userID),'fields'=>array('id','task_id')));
            
            if(!empty($tasks)){
                $taskList = array();
                foreach($tasks AS $taskId => $taskName){
                    $taskList[] = $taskId;
                }
                $cond[] = 'Activity.item_type  = "task" AND Activity.item_id in ('.implode(',',$taskList).')';
                
                $taskComments = $taskComment->find('list',array('conditions' => array('TaskComment.task_id' => $taskList),'fields'=>array('id','body')));
                $this->userTaskCommentList = $taskComments;
                if(!empty($taskComments)){
                    $taskCommentsList = array();
                    foreach($taskComments AS $taskCommentId => $taskCommentBody){
                        $taskCommentsList[] = $taskCommentId;
                    }
                    if(!empty($taskCommentsList)){
                        $cond[] = 'Activity.item_type  = "taskcomment" AND Activity.item_id in ('.implode(',',$taskCommentsList).')';
                    }
                }
            }
            
            $cond[] = 'Activity.item_type  = "lawsuit" AND Activity.event = "new"';
            
            
            $cond[] = 'Activity.item_type  = "invoice" AND Activity.event = "generate"';
            
            
            if(empty($cond)){
                $cond[] = '0';
            }
            $dateFrom = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d')-3, date('Y')));
            $options = array(
                        'conditions' => array(
                            'OR' => $cond,
                            'Activity.viewed' => false,
                            'Activity.created >=' => $dateFrom
                                        )
                );
            
            $userActivities = $activity->find('all', $options);
            //print_r($userActivities); die;
            $this->allNotifications = $userActivities;

            $this->allNotifications = $userActivities;
            $this->countNotifications = count($userActivities);
        }
    }

}
?>