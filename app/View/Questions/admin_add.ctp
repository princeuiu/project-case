<?php
    echo $this->Form->create('Question', array('action' => $this->action)); ?>
    <fieldset> 
        <legend><?php echo __('Add Question'); ?></legend> 
<?php
    echo $this->Form->input('question', array('div'=>array('class'=>'form-group'), 'class'=>'form-control', 'id'=>'focusedInput', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
//    echo $this->Tinymce->input('Departnemt.description', array( 
//            'label' => 'Description'
//            ),array( 
//                'language'=>'en' 
//            ), 
//            'full' 
//        ); 
    echo $this->Form->input('status',array('div'=>array('class'=>'form-group'), 'class'=>'form-control', 'options'=>array("active"=>"active","inactive"=>"inactive")));
?>
    </fieldset>
<?php
    echo $this->Form->submit('Update', array('class'=>'btn btn-default'));
    echo $this->Form->end();