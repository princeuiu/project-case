<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>Units</h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <?php echo $this->Html->tableHeaders(array('Unit Name', 'Unit Symble', 'Status' , 'Actions')); ?>
                </thead>   
                <tbody>
                    
                    <?php foreach ($units as $item): ?>
                        <tr>
                            <td><?php echo $item['Unit']['name']; ?></td>
                            <td><?php echo $item['Unit']['symbol']; ?></td>
                            <td><span class="label <?php if($item['Unit']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Unit']['status']); ?></span></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?php echo $this->Html->url(array('controller' => 'units', 'action' => 'admin_edit', $item['Unit']['id'])); ?>">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="<?php echo $this->Html->url(array('controller' => 'units', 'action' => 'admin_edit', $item['Unit']['id'] , __('Are you sure you want to delete  %s?', $item['Unit']['id']))); ?>">
                                    <i class="halflings-icon white trash"></i> 
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->

