<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>Items</h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <?php echo $this->Html->tableHeaders(array('Image', 'Name', 'Description', 'Status' , 'Actions')); ?>
                </thead>   
                <tbody>
                    
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <?php
                                if(!empty($item["Item"]["image"])){
                                    $imgName = $item["Item"]["image"];
                                }
                                else{
                                    $imgName = 'no_photo_available.jpg';
                                }
                                ?>
                                <?php echo $this->Html->image("items/thumb/".$imgName, array('class' => 'img-thumbnail img-custom-thmb')); ?>
                            </td>
                            <td><?php echo $item['Item']['name']; ?></td>
                            <td><?php echo $item['Item']['description']; ?></td>
                            <td><span class="label <?php if($item['Item']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Item']['status']); ?></span></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?php echo $this->Html->url(array('controller' => 'items', 'action' => 'admin_edit', $item['Item']['id'])); ?>">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="<?php echo $this->Html->url(array('controller' => 'items', 'action' => 'admin_edit', $item['Item']['id'] , __('Are you sure you want to delete  %s?', $item['Item']['id']))); ?>">
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

