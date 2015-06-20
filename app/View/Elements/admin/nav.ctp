<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-tabs">
<!--            <li role="presentation"><a href="#">Home</a></li>-->
            <li role="presentation" class="dropdown<?php if($cont == 'items' || $cont == 'categories' || $cont == 'regions'){ echo ' active';} ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Settings <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation"<?php if($cont == 'items' && ($act == 'admin_add' || $act == 'admin_edit')){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('Add new item', array('controller' => 'Items', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'items' && $act == 'admin_index'){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('List all item', array('controller' => 'Items', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'categories' && ($act == 'admin_add' || $act == 'admin_edit')){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('Add new category', array('controller' => 'Categories', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'categories' && $act == 'admin_index'){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('List all category', array('controller' => 'Categories', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'regions' && ($act == 'admin_add' || $act == 'admin_edit')){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('Add new region', array('controller' => 'Regions', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'regions' && $act == 'admin_index'){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('List all region', array('controller' => 'Regions', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>
            <li role="presentation" class="dropdown<?php if($cont == 'questions'){ echo ' active';} ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Question <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation"<?php if($cont == 'questions' && $act == 'admin_add'){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('Add new question', array('controller' => 'Questions', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <li role="presentation"<?php if($cont == 'questions' && $act == 'admin_index'){ echo ' class="active"';} ?>>
                        <?php echo $this->Html->link('List all questions', array('controller' => 'Questions', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>
            <li role="presentation" class="dropdown<?php if($cont == 'users'){ echo ' active';} ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">User <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
<!--                    <li role="presentation" class="active"><a href="#">Add new user</a></li>
                    <li role="presentation"><a href="#">List all user</a></li>-->
                    <li role="presentation">
                        <?php echo $this->Html->link('Logout', '/logout'); ?>
                    </li>
                </ul>
            </li>
<!--            <li role="presentation">
                <form class="navbar-form navbar-right f" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </li>-->
<!--            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                Settings <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">Profile</a></li>
                </ul>
            </li>-->
        </ul>
    </div>
</div>