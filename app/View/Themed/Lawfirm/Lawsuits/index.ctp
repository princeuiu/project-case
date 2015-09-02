<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white book"></i><span class="break"></span>Cases</h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
            <div class="box-icon">
                <a href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'index')); ?>"><button type="button" class="btn btn-mini <?php if($caseType!='all'){echo ' btn-success';}?>">All</button></a>
                <a href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'landvetting')); ?>"><button type="button" class="btn btn-mini <?php if($caseType!='landvetting'){echo ' btn-success';}?>">Landvetting</button></a>
                <a href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'litigation')); ?>"><button type="button" class="btn btn-mini <?php if($caseType!='litigation'){echo ' btn-success';}?>">Litigation</button></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <?php echo $this->Html->tableHeaders(array('Number', 'Client Name', 'Contact Person', 'Contact Number', 'Status' , 'Created' , 'Created By' , 'Actions')); ?>
                </thead>
                <tbody>

                <?php foreach ($items as $item): ?>
                    <tr>
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
                        <td><?php echo $item['Client']['contact_person']; ?></td>
                        <td><?php echo $item['Client']['phone']; ?></td>
                        <td><span class="label <?php if($item['Lawsuit']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Lawsuit']['status']); ?></span></td>
                        <td><?php echo date("d-m-Y", strtotime($item['Lawsuit']['created'])); ?></td>
                        <td><?php echo $item['Lawsuit']['created_by']; ?></td>
                        <td class="center">
                            <a class="btn btn-info" title="Edit Case" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'edit', $item['Lawsuit']['id'])); ?>">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-success" title="View Case" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'details', $item['Lawsuit']['id'] )); ?>">
                                <i class="halflings-icon th-list white"></i>
                            </a>
                            <a class="btn btn-success" title="Generate Invoice" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'generate', $item['Lawsuit']['id'] )); ?>">
                                <i class="halflings-icon white share"></i>
                            </a>
                            <a class="btn btn-danger" title="Close Case" href="<?php echo $this->Html->url(array('controller' => 'lawsuits', 'action' => 'edit', $item['Lawsuit']['id'] , __('Are you sure you want to close  %s?', $item['Lawsuit']['id']))); ?>">
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

