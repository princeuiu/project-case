<?php
    echo $this->Form->create('Category', array('action' => $this->action, 'type' => 'file')); ?>
    <fieldset> 
        <legend><?php echo __('Add Category'); ?></legend> 
<?php
    echo $this->Form->input('name', array('placeholder' => 'Category name', 'div'=>array('class'=>'form-group'), 'class'=>'form-control', 'id'=>'focusedInput', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
//    echo $this->Tinymce->input('Departnemt.description', array( 
//            'label' => 'Description'
//            ),array( 
//                'language'=>'en' 
//            ), 
//            'full' 
//        );
?>
    <div class="form-group"> <label for="CategoryImage">Category Image</label> 
<?php 
    if(isset($this->data["Category"]["image"]) && $this->data["Category"]["image"] && !is_array($this->data['Category']['image'])){
        echo $this->Html->image("categories/thumb/".$this->data["Category"]["image"], array('class'=>'img-thumbnail'));
        echo "<br />".$this->Html->link("Remove Image","/admin/categories/remove_image/".$this->data["Category"]["image"]);
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