<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'dashboard', 'action' => 'index')); ?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-book"></i><span class="hidden-tablet"> Case </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'add')); ?>"><i class="icon-folder-open"></i><span class="hidden-tablet"> Open new Case</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Cases</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Task</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'all')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Tasks</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'owned')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Owned Tasks</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-hdd"></i><span class="hidden-tablet"> History </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'histories', 'action' => 'add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new History</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'histories', 'action' => 'calender')); ?>"><i class="icon-calendar"></i><span class="hidden-tablet"> View Calender</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'histories', 'action' => 'index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> View all Cases</span></a></li>
                </ul>
            </li>
            <li><a href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'index')); ?>"><i class="icon-money"></i><span class="hidden-tablet"> Invoice List</span></a></li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-wrench"></i><span class="hidden-tablet"> Setup Court </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'courts', 'action' => 'add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Item</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'courts', 'action' => 'index')); ?>"><i class="icon-sitemap"></i><span class="hidden-tablet"> List All Items</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-group"></i><span class="hidden-tablet"> Clients </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Clients</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Client</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-user"></i><span class="hidden-tablet"> User </span><i class="icon-caret-down"></i></a>
                <ul>
<!--                    <li><a class="submenu" href="--><?php //echo $this->Html->url(array('controller' => 'clients', 'action' => 'admin_add')); ?><!--"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Clients</span></a></li>-->
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> Add New User</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'all')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List User</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->