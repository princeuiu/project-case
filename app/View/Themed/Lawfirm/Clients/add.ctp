<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Edit Client'); ?></h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('Client', array(
                'action' => $this->action,
                'class' => 'form-horizontal',
                'inputDefaults' => array(
                    'div' => false,
                    'label' => false
                )
            ));
            ?>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="ClientName">Name </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('name', array('class' => 'span6 typeahead', 'placeholder' => 'Client name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientBranch">Branch </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('branch', array('class' => 'span6 typeahead', 'placeholder' => 'Branch name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientAddress">Address </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('address', array('class' => 'span6 typeahead', 'placeholder' => 'Client Address', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientInvAddressing">Invoice Addressing </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('inv_addressing', array('class' => 'span6 typeahead', 'placeholder' => 'Invoice Addressing', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientContactPerson">Contact Person </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('contact_person', array('class' => 'span6 typeahead', 'placeholder' => 'Contact Person', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientPersonDesignation">Contact Person Designation </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('person_designation', array('class' => 'span6 typeahead', 'placeholder' => 'Contact Person Designation', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ClientPhone">Phone </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('phone', array('class' => 'span6 typeahead', 'placeholder' => '+880-xxxx-xxxxxx', 'error' => array(
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

