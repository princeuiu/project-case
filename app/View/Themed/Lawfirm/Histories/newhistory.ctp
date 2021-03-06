<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Add Case History'); ?></h2>
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
                    <label class="control-label" for="CaseNumber">Case Number</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('lawsuit_id', array('class' => 'span6 typeahead', 'placeholder' => 'Case Number', 'options' => $lawsuits, 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Title">Title </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('title', array('class' => 'span6 typeahead', 'placeholder' => 'Title', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="CourtName">Name of the Court </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('court_name', array('class' => 'span6 typeahead', 'placeholder' => 'CourtName', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Description">Description </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('description', array('type'=>'textarea', 'class' => 'span6 typeahead', 'placeholder' => 'Description', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="ReportingDate">Reporting Date </label>
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
                    <label class="control-label" for="Remarks">Remarks </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('remark', array('type'=>'textarea', 'class' => 'span6 typeahead', 'placeholder' => 'Remarks', 'error' => array(
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

