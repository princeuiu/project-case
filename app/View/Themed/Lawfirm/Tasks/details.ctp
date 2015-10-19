<div class="row-fluid ">
    <div class="span7">
        <h1><?php
            echo $userTasks['Tasklist']['name'];
            ?></h1><br />

        <?php
        if($datediff < 4 && $userTasks['Task']['status'] == 'pending'){
            echo '<div class="priority high"><span>high priority</span></div>
        <div class="task high">';
        }elseif($datediff > 3 &&  $datediff < 11 && $userTasks['Task']['status'] == 'pending'){
            echo '<div class="priority medium"><span>medium priority</span></div>
            <div class="task medium">';
        }elseif($datediff > 10 && $userTasks['Task']['status'] == 'pending'){
            echo '<div class="priority low"><span>low priority</span></div>
                <div class="task low">';
        }
        elseif($userTasks['Task']['status'] == 'done'){
            echo '<div class="priority low"><span>Task completed</span></div>
                <div class="task low">';
        }
        ?>


        <div class="desc">
            <h2>Task for Case :<br /></h2>
            <h2><?php echo ($userTasks['Lawsuit']['type'] != 'landvetting')?$caseNmeTxt.$userTasks['Lawsuit']['number'].'<br />of '.$userTasks['Lawsuit']['year']:'Doc - '.$userTasks['Lawsuit']['number']; ?></h2>
            <div class="title"><?php echo 'Task Name : '.$userTasks['Tasklist']['name']; ?></div>
            <div><?php echo 'Description : '.$userTasks['Task']['description']; ?></div>
            <div>Attachments: </br>
            <?php
            foreach($task_files as $task_file){
                echo '<i class="icon-paper-clip"></i>&nbsp;&nbsp;<a href="/uploads/doc/' . $task_file['WantingDoc']['name'] . '" target="_blank" ><i class="fa fa-paperclip"></i>'. $task_file['WantingDoc']['name'] .'</a></br>';
            }
            ?>
            </div>
        </div>
        <div class="time">
            <div class="date" style="font-size: 14px;"><?php echo $this->Time->format($userTasks['Task']['dead_line'], '%B %e, %Y'); ?></div>
            <?php
                if($userTasks['Task']['status'] == 'done'):
            ?>
                <div class="date" style="font-size: 14px;"><?php echo $this->Time->format($userTasks['Task']['modified'], '%B %e, %Y'); ?></div>
            <?php
                else:
            ?>
                <div><?php echo $datediff; ?> day(s)</div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <?php
    if($userTasks['Task']['status'] == 'pending'):
    ?>
    <div class="box span12" style="margin-left: auto">
        <div class="box-header" data-original-title="">
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>Comment</h2>
        </div>
        <div class="box-content">
            <?php echo $this->Form->create('TaskComments', array('action' => 'add', 'type' => 'file', 'multiple')); ?>

            <fieldset>
                <input name="data[TaskComment][user_id]" id="UserId" type="hidden" value="<?php echo Authsome::get("id") ?>" />
                <input name="data[TaskComment][task_id]" id="TaskId" type="hidden" value="<?php echo $userTasks['Task']['id'] ?>" />
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control span12" rows="2" id="comment" name="data[TaskComment][body]"></textarea>
                </div>
                <div class="form-group">
                <?php
                echo $this->Form->input('files.', array('type' => 'file', 'multiple'));
                ?>
                </div>
                <div class="form-group">
                    <label for="done">
                <?php
                echo $this->Form->checkbox('done', array(
                    'value' => true,
                    'hiddenField' => false,
                    'id' => 'done'
                ));
                ?>
                    Task is done</label>
                </div>
                <div class="form-actions" style="text-align: right">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </fieldset>
            <?php echo $this->Form->end(); ?>

        </div>
    </div>
    <?php
    endif;
    ?>
</div>
<div class="span5 noMarginLeft">
    <div class="dark">

        <h1>Previous Comments</h1>

        <div class="timeline">
            <?php
            $i = 0;
            foreach($taskComments as $comment){
                if ($i%2 == 0){
                    echo '<div class="timeslot" style="height: 124px;"><div class="task"><span><span class="type">';
                }else{
                    echo '<div class="timeslot alt" style="height: 124px;"><div class="task"><span><span class="type">';
                }
//                echo $comment['User']['name'];

                echo '</span><span class="details">';

                echo $comment['TaskComment']['body'];

                echo '</span><span style="-o-text-overflow: ellipsis; text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 150px;">';





                foreach ($comment['WantingDoc'] as $file){
                    echo '<i class="icon-paper-clip"></i>&nbsp;&nbsp;<a href="/uploads/doc/' . $file['name'] . '" target="_blank" ><i class="fa fa-paperclip"></i>'. $file['name'] .'</a></br>';
                };

                echo '<span class="remaining">';

//                echo $comment['TaskComment']['created'];
                echo $this->Time->format($comment['TaskComment']['created'], '%B %e, %Y %H:%M %p');



//                print_r($comment);
                echo '</span></span></span><div class="arrow"></div></div><div class="icon"><i class="icon-calendar"></i></div><div class="time">';

                echo $comment['User']['name'];

                echo '</div></div><div class="clearfix"></div>';

                $i++;
            }
            ?>
        </div>
    </div>

</div>
</div><!--/row-->
