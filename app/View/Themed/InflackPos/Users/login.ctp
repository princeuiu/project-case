<div class="row-fluid">
    <div class="login-box">
        <div class="icons">
            <a href="index.html"><i class="halflings-icon home"></i></a>
            <a href="#"><i class="halflings-icon cog"></i></a>
        </div>
        <h2>Login to your account</h2>
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
            <fieldset>

                <div class="input-prepend" title="Username">
                    <span class="add-on"><i class="halflings-icon user"></i></span>
                    <input class="input-large span10" name="data[User][email]" id="UserEmail" type="text" placeholder="type email" required="required"/>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend" title="Password">
                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                    <input class="input-large span10" name="data[User][password]" id="UserPassword" type="password" placeholder="type password" required="required"/>
                </div>
                <div class="clearfix"></div>

<!--                <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>-->
                <input type="hidden" name="data[User][remember]" id="UserRemember_" value="0">
                <label class="remember" for="remember"><input type="checkbox" name="data[User][remember]" value="1" id="remember">Keep me logged in</label>

                <div class="button-login">	
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="clearfix"></div>
            <?php
                echo $this->Form->end();
            ?>
        <hr>
        <h3><?php echo $this->Html->link('Forget Password?','/'); ?></h3>
    </div><!--/span-->
</div><!--/row-->


