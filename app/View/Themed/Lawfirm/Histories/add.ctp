<?php //pr($lawsuits); die() ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Add New Litigation'); ?></h2>
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('History', array(
                'action' => $this->action,
                'class' => 'form-horizontal',
                'inputDefaults' => array(
                    'div' => false,
                    'label' => false
                )
            ));
            ?>
            <fieldset>`
                <div class="control-group">
                    <label class="control-label" for="HistoryCourt">Select Court</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('court', array(
                            'options' => $courts,
                            'class' => 'historyCourt'
                        ));
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="HistoryCourtId">Select Category</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('court_id', array(
                            'options' => $categories,
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
                            'class' => 'historyYear'
                        ));
                        ?>
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="CaseNumber">Case Number</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('lawsuit_id', array('options' => $lawsuits, 'class' => 'historyCaseNumber'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Title">Step </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('title', array('class' => 'span6 typeahead', 'placeholder' => 'Step', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
<!--                <div class="control-group">
                    <label class="control-label" for="CourtName">Name of the Court </label>
                    <div class="controls">
                        <?php
//                        echo $this->Form->input('court_name', array('class' => 'span6 typeahead', 'placeholder' => 'Name of the Court', 'error' => array(
//                            'attributes' => array('escape' => false)
//                        )));
                        ?>
                    </div>
                </div>-->
                <div class="control-group">
                    <label class="control-label" for="Description">Steps Taken </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('description', array('type'=>'textarea', 'class' => 'span6 typeahead', 'placeholder' => 'Steps Taken', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="ReportingDate">Next Date </label>
                    <div class="controls">
                        <input type="text" name="data[History][reporting_date]" class="input-xlarge datepicker" id="HistoryReportingDate">
                        <?php
//                        echo $this->Form->input('reporting_date', array('type'=>'date', 'class' => 'input-xlarge datepicker hasDatepicker', 'placeholder' => 'Reporting Date', 'error' => array(
//                            'attributes' => array('escape' => false)
//                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="tillNext">Till next hearing</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->checkbox('till_next_hearing', array(
                            'value' => true,
                            'hiddenField' => false,
                            'id' => 'tillNext'
                        ));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Remarks">Purpose of Next Date </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('remark', array('type'=>'textarea', 'class' => 'span6 typeahead', 'placeholder' => 'Purpose of Next Date', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->

