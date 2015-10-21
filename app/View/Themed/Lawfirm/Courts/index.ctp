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
                <?php echo $this->Html->tableHeaders(array('Item name', 'Actions')); ?>
                </thead>
                <tbody>

                <?php foreach ($items as $itemId => $itemName): ?>
                    <tr>
                        <td><?php echo $itemName; ?></td>
                        <td class="center">
                            <a class="btn btn-info" title="Edit Item" href="<?php echo $this->Html->url(array('controller' => 'courts', 'action' => 'edit', $itemId)); ?>">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" title="Delete Item" href="<?php echo $this->Html->url(array('controller' => 'courts', 'action' => 'delete', $itemId )); ?>">
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

<script type="application/javascript">

    $(document).ready(function() {
        $('#thisTable').dataTable({
            "order": false,
            "bPaginate": false
        });
//        alert(?"GG");
    } );

</script>
