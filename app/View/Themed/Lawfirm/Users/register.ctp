<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Update Task'); ?></h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('User', array(
                'action' => $this->action,
                'inputDefaults' => array(
                    'div' => false
                )
            ));
            ?>
            <fieldset>
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
                    <?php echo $this->Form->input('role',array('div'=>array('class'=>'form-group'), 'class'=>'form-control', 'options'=>array("employee"=>"Employee","manager"=>"Manager", "admin"=>"Admin"))); ?>
                </div>
                <div class="form-group">
                    <?php
                    //echo $this->Form->input('group', array('value' => "manager", 'type'=>'hidden'));
                    echo $this->Form->input('status', array('value' => "active", 'type'=>'hidden'));
//                    echo $this->Form->submit('Register', array('class'=>'btn btn-default'));
                    ?>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </fieldset>
            <?php
            echo $this->Form->end();
            ?>

        </div>
    </div><!--/span-->

</div><!--/row-->







