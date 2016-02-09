<?php
    echo $this->Form->create('Item', array('action' => $this->action, 'type' => 'file')); ?>
    <fieldset> 
        <legend><?php echo __('Add Item'); ?></legend> 
    <div class="form-group"> <label for="ItemCategoryId">Category</label>
<?php
    echo $this->Form->select('category_id', $categories, array('empty'=>false, 'div'=>array('class'=>'form-group'), 'class'=>'form-control', 'label'=>'Select Category'));
?>
    </div>
    <div class="form-group"> <label for="ItemRegionId">Region</label>
<?php
    echo $this->Form->select('region_id', $regions, array('empty'=>false, 'div'=>array('class'=>'form-group'), 'class'=>'form-control', 'label'=>'Select Category'));
?>
    </div>
<?php
    echo $this->Form->input('name', array('placeholder' => 'Item name', 'div'=>array('class'=>'form-group'), 'class'=>'form-control', 'id'=>'focusedInput', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
?>
<div class="form-group"> <label for="ItemImage">Item Image</label> 
<?php 
    if(isset($this->data["Item"]["image"]) && $this->data["Item"]["image"] && !is_array($this->data['Item']['image'])){
        echo $this->Html->image("items/thumb/".$this->data["Item"]["image"], array('class'=>'img-thumbnail'));
        echo "<br />".$this->Html->link("Remove Image","/admin/items/remove_image/".$this->data["Item"]["image"]);
    }
    echo "<br /><br />";
    echo $this->Form->file('image', array('class'=>'form-control'));
?>
    </div>
<?php
    echo $this->Form->input('status',array('div'=>array('class'=>'form-group'), 'class'=>'form-control', 'options'=>array("active"=>"active","inactive"=>"inactive")));
?>
    </fieldset>
<?php
    echo $this->Form->submit('Update', array('class'=>'btn btn-default'));
    echo $this->Form->end();