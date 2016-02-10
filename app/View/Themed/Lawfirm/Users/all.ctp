<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white book"></i><span class="break"></span>Cases</h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <?php echo $this->Html->tableHeaders(array('Name', 'Email', 'Role', 'Date Added', 'Status' , 'Actions')); ?>
                </thead>
                <tbody>

                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['User']['name'] ;?></td>
                        <td><?php echo $item['User']['email']; ?></td>
                        <td><?php echo $item['User']['role']; ?></td>
<!--                    <td>--><?php //echo $item['User']['status']; ?><!--</td>-->
                        <!--<td><?php /*echo $item['User']['created']; */?></td>-->
                        <td><?php echo date("d-m-Y", strtotime($item['User']['created'])); ?></td>
                        <td><span class="label <?php if($item['User']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo ($item['User']['status']); ?></span></td>
                        <td class="center">
                            <a class="btn btn-success" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'details', $item['User']['id'] )); ?>">
                                <i class="halflings-icon th-list white"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

