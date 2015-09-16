<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Open/Edit Case'); ?></h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
            <div class="box-icon">
                <?php
                echo '<a href="/tasks/newtask/'.$case_id.'">';
                ?><i class="icon-tasks">Assign Task</i></a>
            </div>
        </div>

        <div class="box-content">
            <?php
            echo $this->Form->create('Lawsuit', array(
                'action' => $this->action,
                'class' => 'form-horizontal',
                'type' => 'file',
                'inputDefaults' => array(
                    'div' => false,
                    'label' => false
                )
            ));
            ?>
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="LawsuitNumber">Number / Name </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('number', array('class' => 'span6 typeahead', 'placeholder' => 'Case number', 'error' => array(
                            'attributes' => array('escape' => true)
                        )));
                        ?>
                    </div>
                </div>
                <div class="control-group hidden-phone">
                    <label class="control-label" for="LawsuitNote">Note</label>
                    <div class="controls">
                        <?php echo $this->Form->textarea('note', array('class'=>'cleditor')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitClientId">Select Client</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('client_id', array(
                            'options' => $clients,
                            'data-rel' => 'chosen'
                        ));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitType">Type</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('type', array(
                            'options' => array('landvetting' => 'Landvetting','litigation' => 'Litigation'),
                            'data-rel' => 'chosen'
                        ));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitStatus">Status</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('status', array(
                            'options' => array('active' => 'Active','inactive' => 'Inactive'),
                            'data-rel' => 'chosen'
                        ));
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div><!--/span-->

</div><!--/row-->
