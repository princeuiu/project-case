<?php
App::uses('AppHelper', 'View/Helper');

class NumtowordHelper extends AppHelper {

    public $helpers = array('Html', 'Text');

    function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


    public function renderNotification() {
        ?>
        <li class="dropdown hidden-phone">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-bell"></i>
        <?php if ($this->countNotifications > 0): ?>
                    <span class="badge red"> <?php if ($this->countNotifications < 100) {
                echo $this->countNotifications;
            } else {
                echo '99+';
            } ?> </span>
        <?php endif; ?>
            </a>

        <li class="dropdown-menu-title">
            <span>You have <?php echo $this->countNotifications; ?> notifications</span>
        <!--                    <a href="#refresh"><i class="icon-repeat"></i></a>-->
        </li>
        <?php foreach ($this->allNotifications as $notification): ?>
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
            print_r($userActivities);
            die;

            $this->allNotifications = $userActivities;
            $this->countNotifications = count($userActivities);
        }
    }

}
?>