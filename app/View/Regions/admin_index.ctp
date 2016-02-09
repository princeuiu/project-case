<h2><?php echo __('Regions'); ?></h2>
<table class="table table-hover">
<tr>
        <th><?php echo $this->Paginator->sort('Name'); ?></th>
        
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo $this->Paginator->sort('created', 'Created Date'); ?></th>
        <th><?php echo $this->Paginator->sort('modified', 'Modified Date'); ?></th>
        
</tr>
<?php
foreach ($designations as $item): ?>
<tr>
    <td><?php echo $item['Region']['name']; ?><br /><?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $item['Region']['id']), array('class' => 'smallerLink')); ?>&nbsp;|&nbsp;<?php echo $this->Html->link(__('Delete'), array('action' => 'admin_delete', $item['Region']['id']), array('class' => 'smallerLink'), __('Are you sure you want to delete  %s?', $item['Region']['name'])); ?></td>
    <td><?php echo h($item['Region']['status']); ?>&nbsp;</td>
    <td><?php echo $this->Time->nice($item['Region']['created']); ?></td>
    <td><?php echo $this->Time->nice($item['Region']['modified']); ?>&nbsp;</td>
    
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
