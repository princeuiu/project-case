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
            <table id="thisTable" class="table table-striped table-bordered">
                <thead>
                <?php echo $this->Html->tableHeaders(array('Task Name', 'Case Type', 'Status' , 'Created' , 'Actions')); ?>
                </thead>
                <tbody>

                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['Tasklist']['name']; ?></td>
                        <td><?php echo $item['Tasklist']['type']; ?></td>
                        <td><span class="label <?php if($item['Tasklist']['status']== 'active'){ echo 'label-success'; } else{ echo 'label-warning';} ?>"><?php echo h($item['Tasklist']['status']); ?></span></td>
                        <td><?php echo date("d-m-Y", strtotime($item['Tasklist']['created'])); ?></td>
                        <td class="center">
                            <a class="btn btn-info" title="Edit Task" href="<?php echo $this->Html->url(array('controller' => 'tasklists', 'action' => 'edit', $item['Tasklist']['id'])); ?>">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <?php
                            if($item['Tasklist']['status']!= 'inactive'):
                                ?>
                                <a class="btn btn-danger btnCaseClose" title="Delete Task" data-case-id="<?php echo $item['Tasklist']['id']; ?>" href="<?php echo $this->Html->url(array('controller' => 'tasklists', 'action' => 'delete', $item['Tasklist']['id'])); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                                <?php
                            endif;
                            ?>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <div class="pagination">
                <ul>
                    <?php
                        echo $this->Paginator->prev(__('← Previous'), array('tag' => 'li'));
                        $options = array(
                            'separator' => '',
                            'tag' => 'li',
                            'currentClass' => 'active'
                        );
                        echo $this->Paginator->numbers($options); 
                        echo $this->Paginator->next(__('Next → '), array('tag' => 'li'));
                    ?>
                </ul>
            </div>
        </div>
    </div><!--/span-->

</div><!--/row-->

<script type="application/javascript">

    $(document).ready(function() {
        $('#thisTable').dataTable({
            "order": false,
            "bPaginate": false
        });
//        alert(?"GG");
    } );

</script>
