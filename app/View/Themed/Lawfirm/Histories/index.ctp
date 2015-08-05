<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>Clients</h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <?php echo $this->Html->tableHeaders(array('Name', 'Address', 'Contact Person', 'Phone' , 'Status' , 'Actions')); ?>
                </thead>   
                <tbody>
                    
                    <?php foreach ($clients as $item): ?>
                        <tr>
                            <td><?php echo $item['Client']['name']; ?></td>
                            <td><?php echo $item['Client']['address']; ?></td>
                            <td><?php echo $item['Client']['contact_person']; ?></td>
                            <td><?php echo $item['Client']['phone']; ?></td>
                            <td><span class="label <?php if($item['Client']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Client']['status']); ?></span></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'edit', $item['Client']['id'])); ?>">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="<?php echo $this->Html->url(array('controller' => 'clients', 'action' => 'edit', $item['Client']['id'] , __('Are you sure you want to delete  %s?', $item['Client']['id']))); ?>">
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

