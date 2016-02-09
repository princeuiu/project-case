<h2><?php echo __('Food Items'); ?></h2>
<div class="table-responsive">
<table class="table table-hover table-employee">
<tr>
        <th><?php echo $this->Paginator->sort('Name'); ?></th>
        <th><?php echo __('Category'); ?></th>
        <th><?php echo __('Region'); ?></th>
        
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo __('Action') ?></th>
        
</tr>
<?php
foreach ($items as $item): ?>
<tr>
    <td><?php echo $this->Html->image("items/thumb/".$item["Item"]["image"], array('class' => 'img-thumbnail img-custom-thmb', 'url' => array('action' => 'admin_detail', $item['Item']['slug']))); ?><br /><?php echo $this->Html->link($item['Item']['name'], array('action' => 'admin_detail', $item['Item']['slug']), array('class'=>'font-bold')); ?>
        <br /><?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $item['Item']['id']), array('class' => 'smallerLink')); ?>&nbsp;|&nbsp;<?php echo $this->Html->link(__('Delete'), array('action' => 'admin_delete', $item['Item']['id']), array('class' => 'smallerLink'), __('Are you sure you want to delete  %s?', $item['Item']['name'])); ?></td>
    <td><?php echo h($item['Category']['name']); ?>&nbsp;</td>
    <td><?php echo h($item['Region']['name']); ?>&nbsp;</td>
    
    <td><?php echo h($item['Item']['status']); ?>&nbsp;</td>
    <td>
        <a href="javascript:" class="btn btn-default btn-submit <?php echo (in_array((int)$item['Item']['id'], $rateIds,false))? 'btnRemoveFromRate' : 'btnAddToRate'; ?>" data-item-id="<?php echo $item['Item']['id']; ?>"><?php echo (in_array((int)$item['Item']['id'], $rateIds,false))? __('Remove from Rate') : __('Add to Rate'); ?></a>
    </td>
    
</tr>
<?php endforeach; ?>
<tr>
    <td>&nbsp;</td>
    <td colspan="2">
        <?php echo $this->Html->link(__('Start Rating'), array('action' => 'review', 'admin'=>false), array('class' => 'btn btn-default btn-submit')); ?>
    </td>
</tr>
</table>
</div>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>  </p>

<?php echo $this->Paginator->numbers(array('separator' => '', 'tag'=>'li')); ?>
