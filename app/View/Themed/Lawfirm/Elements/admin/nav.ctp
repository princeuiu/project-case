<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="index.html"><i class="icon-dashboard"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
            <li>
                <a class="dropmenu" href="#"><i class="icon-book"></i><span class="hidden-tablet"> Case </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'admin_add')); ?>"><i class="icon-folder-open"></i><span class="hidden-tablet"> Open new Case</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'admin_index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Cases</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-bookmark"></i><span class="hidden-tablet"> Brand </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'brands', 'action' => 'admin_add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Brand</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'brands', 'action' => 'admin_index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Brands</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-group"></i><span class="hidden-tablet"> Clients </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'admin_add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Clients</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'admin_index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Client</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-cogs"></i><span class="hidden-tablet"> Unit </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'units', 'action' => 'admin_add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Unit</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'units', 'action' => 'admin_index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Units</span></a></li>
                </ul>	
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-money"></i><span class="hidden-tablet"> Currency </span><i class="icon-caret-down"></i></a>
                <ul>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'currencies', 'action' => 'admin_add')); ?>"><i class="icon-plus-sign"></i><span class="hidden-tablet"> Add new Currency</span></a></li>
                    <li><a class="submenu" href="<?php echo $this->Html->url(array('controller' => 'currencies', 'action' => 'admin_index')); ?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> List All Currencies</span></a></li>
                </ul>	
            </li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->