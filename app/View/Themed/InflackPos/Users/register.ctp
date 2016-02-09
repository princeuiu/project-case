<?php
    echo $this->Form->create('User', array(
        'action' => $this->action,
        'inputDefaults' => array(
                'div' => false
            )
        ));
?>
<div class="form-group">
<?php
    echo $this->Form->input('name', array('label' => 'Name', 'id'=>'reg_user_name', 'class'=>'form-control', 'placeholder'=>'Enter name', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
?>
</div>
<div class="form-group">
<?php
    echo $this->Form->input('email', array('label' => 'Email', 'class'=>'form-control', 'placeholder'=>'Enter email', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
?>
</div>
<div class="form-group">
<?php
    echo $this->Form->input('password', array('label' => "Password", 'class'=>'form-control', 'placeholder'=>'Enter password', 'error' => array(
                    'attributes' => array('escape' => false)
                )));
?>
</div>
<div class="form-group">
<?php
    echo $this->Form->input('repassword', array('label' => "Retype password", 'class'=>'form-control', 'placeholder'=>'Retype password', 'type'=>'password'));
?>
</div>
<!--<div class="form-group">
<?php
//    echo $this->Recaptcha->display(array(
//        'recaptchaOptions' => array(
//                'theme' => 'blackglass'
//            )
//        )
//    );
?>
</div>-->
<div class="form-group">
    <?php echo $this->Form->input('group',array('div'=>array('class'=>'form-group'), 'class'=>'form-control', 'options'=>array("admin"=>"Admin","manager"=>"Manager"))); ?>
</div>
<div class="form-group">
<?php
    //echo $this->Form->input('group', array('value' => "manager", 'type'=>'hidden'));
    echo $this->Form->input('status', array('value' => "active", 'type'=>'hidden'));
    echo $this->Form->submit('Register', array('class'=>'btn btn-default'));
?>
</div>
<?php
    echo $this->Form->end();
?>