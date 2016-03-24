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
            <div class="row-fluid">
                <div class="span5">
                    <?php
                    echo $this->Form->create('History', array(
                        'action' => $this->action,
                        'class' => 'form-inline',
                        'id' => 'courtViaSearchForm',
                        'type' => 'file',
                        'inputDefaults' => array(
                            'div' => false,
                            'label' => false
                        )
                    ));
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="HistoryClient">Select Client</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('court', array(
                                'options' => $clients,
                                'class' => 'historyClient',
                                'name' => 'client'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="HistoryCourt">Select Court</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('court', array(
                                'options' => $courts,
                                'class' => 'historyCourt',
                                'name' => 'pCourt',
                                'data-controllername' => $controller,
                                'data-actionname' => $action
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="control-group">
                        <label class="control-label" for="HistoryCourtId">Select Category</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('court_id', array(
                                'options' => $categories,
                                'name' => 'court',
                                'class' => 'historyCourtId'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="HistoryYear">Year</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('year', array(
                                'options' => $years,
                                'name' => 'year',
                                'class' => 'historyYear'
                            ));
                            ?>
                            <button type="submit" class="btn btn-primary" id="btnSearchViaCourt">Go</button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        <?php if(!empty($historiesData)): ?>
            <table class="table table-striped table-bordered bootstrap-datatable">
                <thead>
                    <?php echo $this->Html->tableHeaders(array('Case Number', 'Court Name', 'Appearing For', 'Steps Taken', 'Next Date', 'Purpose of Next Date')); ?>
                </thead>
                <tbody>



                    <?php foreach ($historiesData as $eachHistoryData): ?>
                        <?php //pr($case);  die();   ?>


                        <tr>
                            <td><a href="<?php echo $this->Html->url(array("controller" => "lawsuits", "action" => "details", $eachHistoryData['Lawsuit']['id'])); ?>"><?php echo $eachHistoryData['Lawsuit']['courtPrefix'] . $eachHistoryData["Lawsuit"]["case_no"] . ' of ' . $eachHistoryData["Lawsuit"]["year"]; ?></a></td>
                            <td><?php echo $eachHistoryData['Lawsuit']['court_name']; ?></td>
                            <td><?php echo $eachHistoryData['Lawsuit']['appearing_for']; ?></td>
                            <td style="max-width: 200px;"><?php echo $eachHistoryData['History']['description']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($eachHistoryData['History']['reporting_date'])); ?></td>
                            <td style="max-width: 200px;"><?php echo $eachHistoryData['History']['remark']; ?></td>
                            <!--<td class="center">
                                <a class="btn btn-success" href="<?php /* echo $this->Html->url(array('controller' => 'histories', 'action' => 'timeline', $case['Lawsuit']['id'] )); */ ?>">
                                    <i class="halflings-icon white eye-open"></i>
                                </a>
                            </td>-->

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
        <?php else: ?>
            <div class="alert alert-block ">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Oupss!!</h4>
                <p>Nothing to display.</p>
            </div>
        <?php endif; ?>
        </div>
    </div><!--/span-->

</div><!--/row-->

