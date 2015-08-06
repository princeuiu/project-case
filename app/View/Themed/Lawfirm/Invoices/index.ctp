<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white book"></i><span class="break"></span>Invoices</h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <?php echo $this->Html->tableHeaders(array('Ref. Name', 'Case Number', 'Client Name', 'Amount', 'Status' , 'Actions')); ?>
                </thead>   
                <tbody>
                    
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo $item['Invoice']['name']; ?></td>
                            <td>
                                <?php
                                if(!empty($item["Lawsuit"]["number"])){
                                    $number = $item["Lawsuit"]["number"];
                                }
                                else{
                                    $number = '<span style="color:red;">Not yet given</span>';
                                }
                                ?>
                                <?php echo $number ?>
                            </td>
                            <td><?php echo $item['Client']['name']; ?></td>
                            <td><?php echo $item['Invoice']['final_amount']; ?></td>
                            <td><span class="label <?php if($item['Invoice']['status']== 'paid'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Invoice']['status']); ?></span></td>
                            <td class="center">
                                <a class="btn btn-info" title="Export Pdf" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'detail', $item['Invoice']['id'].'.pdf')); ?>">
                                    <i class="halflings-icon white print"></i>  
                                </a>
                                <a class="btn btn-info" title="Edit Invoice" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'edit', $item['Invoice']['id'])); ?>">
                                    <i class="halflings-icon white edit"></i> 
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->

