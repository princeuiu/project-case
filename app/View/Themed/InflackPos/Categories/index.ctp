<div class="row mg-btm-20">
    <?php
    $count = 1;
    $colStart = true;
    $colEnd = false;
    if(!empty($categories)){
        foreach($categories as $category):
            if($colStart):
        ?>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 noMargin noPadding">
        <?php
            $colStart = false;
            endif;
        ?>
            <div class="col-lg-12 sm-align-center mg-all-5px pd-all-5px">
                <?php echo $this->Html->image("categories/resize/".$category["Category"]["image"], array('class' => 'img-responsive border-radious-10','url' => array('controller' => 'items', 'action' => 'lists', $category["Category"]["slug"]))); ?>
                <div class="employee-name mg-btm-20">
                    <p><?php 
                        echo $this->Html->link(
                            $category['Category']['name'],
                            array('controller' => 'items', 'action' => 'lists', $category["Category"]["slug"]),
                            array('class' => 'link-white')
                        );
                    ?></p>
                </div>
            </div>
        <?php
            if($count == $itemEachRow){
                $colStart = true;
                $colEnd = true;
                $count = 0;
            }
            if($colEnd):
        ?>
        </div>
        <?php
            $colEnd = false;
            endif;
            $count++;
        endforeach;
    }
    else{
        echo '<div class="alert alert-info" role="alert">No record to show!</div>';
    }
        ?>
</div>




<?php /*

<h2><?php echo __('Categories'); ?></h2>
<table class="table table-hover">
<tr>
        <th><?php echo $this->Paginator->sort('Name'); ?></th>
        
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo $this->Paginator->sort('created', 'Created Date'); ?></th>
        <th><?php echo $this->Paginator->sort('modified', 'Modified Date'); ?></th>
        
</tr>
<?php
foreach ($departments as $item): ?>
<tr>
    <td><?php echo $item['Category']['name']; ?><br /><?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $item['Category']['id']), array('class' => 'smallerLink')); ?>&nbsp;|&nbsp;<?php echo $this->Html->link(__('Delete'), array('action' => 'admin_delete', $item['Category']['id']), array('class' => 'smallerLink'), __('Are you sure you want to delete  %s?', $item['Category']['name'])); ?></td>
    <td><?php echo h($item['Category']['status']); ?>&nbsp;</td>
    <td><?php echo $this->Time->nice($item['Category']['created']); ?></td>
    <td><?php echo $this->Time->nice($item['Category']['modified']); ?>&nbsp;</td>
    
</tr>
<?php endforeach; ?>
</table>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>  </p>

<?php echo $this->Paginator->numbers(array('separator' => '', 'tag'=>'li')); ?> */
