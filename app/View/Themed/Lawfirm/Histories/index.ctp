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
                <?php echo $this->Html->tableHeaders(array('Case Number', 'Client Name', 'Invoice Status', 'Status' , 'Actions')); ?>
                </thead>
                <tbody>

                <?php foreach ($cases as $case): ?>
                    <tr>
                        <td><?php echo $case['Lawsuit']['number']; ?></td>
                        <td><?php echo $case['Client']['name']; ?></td>
                        <td><?php echo $case['Lawsuit']['invoice_period']; ?></td>
                        <td><span class="label <?php if($case['Lawsuit']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($case['Lawsuit']['status']); ?></span></td>
                        <td class="center">
                            <a class="btn btn-success" href="<?php echo $this->Html->url(array('controller' => 'histories', 'action' => 'timeline', $case['Lawsuit']['id'] )); ?>">
                                <i class="halflings-icon white eye-open"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

