<h2><?php echo __('Questions'); ?></h2>
<table class="table table-hover">
<tr>
        <th><?php echo $this->Paginator->sort('Question'); ?></th>
        
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo $this->Paginator->sort('created', 'Created Date'); ?></th>
        <th><?php echo $this->Paginator->sort('modified', 'Modified Date'); ?></th>
        
</tr>
<?php
foreach ($questions as $item): ?>
<tr>
    <td><?php echo $item['Question']['question']; ?><br /><?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $item['Question']['id']), array('class' => 'smallerLink')); ?>&nbsp;|&nbsp;<?php echo $this->Html->link(__('Delete'), array('action' => 'admin_delete', $item['Question']['id']), array('class' => 'smallerLink'), __('Are you sure you want to delete  %s?', $item['Question']['question'])); ?></td>
    <td><?php echo h($item['Question']['status']); ?>&nbsp;</td>
    <td><?php echo $this->Time->nice($item['Question']['created']); ?></td>
    <td><?php echo $this->Time->nice($item['Question']['modified']); ?>&nbsp;</td>
    
</tr>
<?php endforeach; ?>
</table>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>  </p>

<?php echo $this->Paginator->numbers(array('separator' => '', 'tag'=>'li')); ?>
