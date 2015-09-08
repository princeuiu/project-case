<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Open/Edit Case'); ?></h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
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
                        <?php echo $this->Form->textarea('note', array('class' => 'cleditor')); ?>
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
                        <button class="btn btn-primary add_client_button" title="Add new client" style="padding: 1px 6px; margin-top: -16px;" data-toggle="modal" data-target="#myModal"><i class="halflings-icon white white plus-sign"></i></button>
                    </div>

                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitType">Type</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('type', array(
                            'options' => array('landvetting' => 'Landvetting', 'litigation' => 'Litigation'),
                            'data-rel' => 'chosen'
                        ));
                        ?>
                    </div>
                </div>
                <div id="litigationExtraField">
                    <div class="control-group">
                        <label class="control-label" for="LawsuitLitigationType">Litigation Case type</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('litigation_type', array(
                                'options' => array('criminal' => 'Criminal'),
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="LawsuitParty01">Name of 1st Party</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('party_01', array('class' => 'span6 typeahead', 'placeholder' => 'Name of 1st Party', 'error' => array(
                                    'attributes' => array('escape' => true)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="LawsuitParty02">Name of 2nd Party</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('party_02', array('class' => 'span6 typeahead', 'placeholder' => 'Name of 2nd Party', 'error' => array(
                                    'attributes' => array('escape' => true)
                            )));
                            ?>
                        </div>
                    </div>

                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitBreakPoint">Invoicing Break Period</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('break_point', array(
                            'options' => array('0' => 'At a time', '1' => 'Break in 2 periods', '2' => 'Break in 3 periods'),
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
                            'options' => array('active' => 'Active', 'inactive' => 'Inactive'),
                            'data-rel' => 'chosen'
                        ));
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="LawsuitCreated">Created</label>
                    <div class="controls">
                        <input type="text" name="data[Lawsuit][created]" class="input-xlarge datepicker" id="LawsuitCreated" <?php
                        if (isset($this->data['Lawsuit']['created'])) {
                            echo 'value="' . $this->data['Lawsuit']['created'] . '"';
                        }
                        ?>>
                               <?php
                               //                            echo $this->Form->input('dead_line', array(
                               //                                'class' => 'input-xlarge datepicker',
                               //                                'value' => '01/07/15'
                               //                            ));
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
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Edit Client'); ?></h2>
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
                                        <label class="control-label" for="ClientPhone">Phone </label>
                                        <div class="controls">
                                            <?php
                                            echo $this->Form->input('phone', array('class' => 'span6 typeahead', 'placeholder' => '+880-xxxx-xxxxxx', 'error' => array(
                                                    'attributes' => array('escape' => false)
                                            )));
                                            ?>
                                        </div>
                                    </div>
                                </fieldset>
                                </form>   

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="save-client-on-fly">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div><!--/span-->

</div><!--/row-->
