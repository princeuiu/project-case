<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-7">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>Your Opinion Matter for Us!</h2>
            </div>
        </div>
        <div class="login-panel panel panel-default login-panel">
            <div class="panel-body">
                <?php
                    echo $this->Form->create('User', array(
                        'action' => $this->action,
                        'class' => 'form-horizontal',
                        'inputDefaults' => array(
                                'div' => false,
                                'label' => false
                            )
                        ));
                ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <label for="UserEmail" class="control-label">Email</label>
                        <?php echo $this->Form->input('email', array('class'=>'form-control', 'placeholder'=>'Enter email')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <label for="UserPassword" class="control-label">Password</label>
                        <?php echo $this->Form->input('password', array('class'=>'form-control', 'placeholder'=>'Enter password')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                      <div class="checkbox">
                          <input type="hidden" name="data[User][remember]" id="UserRemember_" value="0">
                          <label for="UserRemember"><input type="checkbox" name="data[User][remember]" value="1" id="UserRemember">Keep me logged in</label>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <input class="btn btn-default btn-submit" type="submit" value="Login">
                    </div>
                </div>
                <?php
                    echo $this->Form->end();
                ?>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <?php echo $this->Html->link('Forget Password?','/'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

