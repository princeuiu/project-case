<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>View Litigation Diary</h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <?php echo $this->Html->tableHeaders(array('Case Number', 'Court Name', 'Date', 'Next Date' , 'Step for next Date')); ?>
                </thead>
                <tbody>



                <?php foreach ($cases as $case):?>
                  <?php  //pr($case);  die();   ?>


                    <tr>
                        <td><?php echo $allCourts[$case["Court"]["parent_id"]]. ' - ' .  $allCourts[$case["Court"]["id"]] . ' - ' . $case["Lawsuit"]["case_no"] . ' of ' . $case["Lawsuit"]["year"]; ?></td>
                        <td><?php echo $case['Lawsuit']['court_name']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($case['History'][0]['created'])); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($case['History'][0]['reporting_date'])); ?></td>
                        <td><?php echo $case['History'][0]['remark']; ?></td>
                        <!--<td class="center">
                            <a class="btn btn-success" href="<?php /*echo $this->Html->url(array('controller' => 'histories', 'action' => 'timeline', $case['Lawsuit']['id'] )); */?>">
                                <i class="halflings-icon white eye-open"></i>
                            </a>
                        </td>-->

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

