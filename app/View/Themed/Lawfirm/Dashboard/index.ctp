<div class="box black span4 noMargin">
    <div class="box-header">
        <h2><i class="halflings-icon white check"></i><span class="break"></span>Task Assigned</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
        <div class="todo metro">
            <ul>
                <?php
                foreach ($assigned_tasks as $assigned_task){
                    $now = time();
                    $dead_line = strtotime($assigned_task['Task']['dead_line']);
                    $datediff = $dead_line - $now;
                    $datediff = floor($datediff/(60*60*24));
                    if($datediff < 4){
                        echo '<li class="red"><a class="action " href="#"></a>'.$assigned_task['Task']['name'].'<strong>'.$assigned_task['Task']['dead_line'].'</strong></li>';
                    }elseif($datediff > 3 &&  $datediff < 11){
                        echo '<li class="yellow"><a class="action " href="#"></a>'.$assigned_task['Task']['name'].'<strong>'.$assigned_task['Task']['dead_line'].'</strong></li>';
                    }else{
                        echo '<li class="green"><a class="action " href="#"></a>'.$assigned_task['Task']['name'].'<strong>'.$assigned_task['Task']['dead_line'].'</strong></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="box white span4 noMargin">
    <div class="box-header">
        <h2><i class="halflings-icon white check"></i><span class="break"></span>History</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
        <div class="todo metro">
            <ul>
                <?php
                foreach ($new_histories as $new_historie){
                    $color = 'green';
                    if ($new_historie['History']['reporting_date'] == date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"), date("Y")))){
                        $color = 'red';
                    }elseif ($new_historie['History']['reporting_date'] == date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))){
                        $color = 'yellow';
                    }
                    echo '<li class="'.$color.'"><a class="action " href="#"></a>'.$new_historie['History']['title'].'<strong><a href='.$this->Html->url(array('controller' => 'histories', 'action' => 'view', $new_historie['History']['id'])).'> View details</a></strong></li>';

                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="box black span3 noMargin">
    <div class="box-header">
        <h2><i class="halflings-icon white check"></i><span class="break"></span>New Cases</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
        <div class="todo metro">
            <ul>
                <?php
                foreach ($new_lawsuits as $this_lawsuit){
                    echo '<li class="red"><a class="action " href="#"></a>'.$this_lawsuit['Client']['slug'].$this_lawsuit['Lawsuit']['id'].'<strong><a href='.$this->Html->url(array('controller' => 'lawsuits', 'action' => 'edit', $this_lawsuit['Lawsuit']['id'])).'> Add File Number</a></strong></li>';

                }
                ?>
            </ul>
        </div>
    </div>
</div>

