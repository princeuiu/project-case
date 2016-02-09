<div class="row-fluid">

    <div class="span9">
        <h1>Tasks</h1>

        <?php
        foreach ($tasks as $task):
            if ($task['Task']['datediff'] < 4):
                ?>
                <div class="priority high"><span>high priority</span><a style="float: right;" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id'])) ?>"><i class="icon-wrench"></i></a></div>
                <div class="task high" style="min-height: 86px;">
                <?php
            elseif ($task['Task']['datediff'] > 3 && $task['Task']['datediff'] < 11):
                ?>
                <div class="priority medium"><span>medium priority</span><a style="float: right;" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id'])) ?>"><i class="icon-wrench"></i></a></div>
                <div class="task medium" style="min-height: 86px;">
                <?php
            elseif ($task['Task']['datediff'] > 10):
                ?>
                <div class="priority low"><span>low priority</span><a style="float: right;" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id'])) ?>"><i class="icon-wrench"></i></a></div>
                <div class="task low" style="min-height: 86px;">
                <?php
            endif;
            ?>
                    <div class="desc">
                        <div class="title"><?php echo '<a href="' . $this->Html->url(array('controller' => 'tasks', 'action' => 'details', $task['Task']['id'])) . '">' . $task['Tasklist']['name'] . '</a>'; ?></div>
                        <div><?php echo $task['Task']['description']; ?></div>
                    </div>
                    <div class="time">
                        <div class="date"><?php echo $this->Time->format('jS F, Y',$task['Task']['dead_line']); ?></div>
                        <div><?php echo $task['Task']['datedifftxt']; ?></div>
                    </div>
                </div>
                <?php
            endforeach;
                ?>
    </div>
</div>