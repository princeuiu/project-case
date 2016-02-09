<!--<script>
    $(document).ready(function(){
        $('#LawsuitCreated').datepicker({
            dateFormat: 'dd-mm-YY';
        });
    });
</script>-->

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Open/Edit File'); ?></h2>
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
                <div id="litigationCaseTypeField">
                    <div class="control-group">
                        <label class="control-label" for="LawsuitCourt">Select Court</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('court', array(
                                'options' => $courts,
                                'class' => 'lawsuitCourt'
                            ));
                            ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="LawsuitCourtId">Select Category</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('court_id', array(
                                'options' => $categories,
                                'class' => 'lawsuitCourtId'
                            ));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="LawsuitCaseNo">Case No</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('case_no', array('class' => 'span6 typeahead', 'placeholder' => 'Case No', 'error' => array(
                            'attributes' => array('escape' => true)
                        )));
                        ?>
                    </div>
                </div>


                <div id="litigationYearField">

                    <div class="control-group">
                        <label class="control-label" for="LawsuitYear"></label>
                        <div class="controls">
                            <span>of</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="LawsuitYear">Year</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('year', array(
                                'options' => $years,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <!--<div class="control-group">
                        <label class="control-label" for="LawsuitFileNo">File No</label>
                        <div class="controls">
                            <?php
/*                                echo $this->Form->input('file_no', array('class' => 'span6 typeahead', 'placeholder' => 'File No', 'error' => array(
                                        'attributes' => array('escape' => true)
                                )));
                            */?>
                        </div>
                    </div>-->
                </div>


                <div class="control-group">
                    <label class="control-label" for="LawsuitCourtName">Name of the Court </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('court_name', array('class' => 'span6 typeahead', 'placeholder' => 'Name of the Court', 'error' => array(
                            'attributes' => array('escape' => false)
                        )));
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="LawsuitNumber">File No</label>
                    <div class="controls">
                        <?php
                        if(isset($cNumber)){
                            echo $this->Form->input('number', array('class' => 'span6 typeahead', 'value' => $cNumber, 'placeholder' => 'Case number', 'error' => array(
                                'attributes' => array('escape' => true)
                            )));
                        }
                        else{
                            echo $this->Form->input('number', array('class' => 'span6 typeahead', 'placeholder' => 'Case number', 'error' => array(
                                'attributes' => array('escape' => true)
                            )));
                        }

                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="LawsuitCourtName">Shelf Entry No </label>
                    <div class="controls">
                        <?php
                        echo $this->Form->input('shelf_no', array('class' => 'span6 typeahead', 'placeholder' => 'Shelf Entry No', 'error' => array(
                            'attributes' => array('escape' => false)
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
                <div id="corpClient">
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
                </div>
                <div id="notCorpClient">
                    <div class="control-group">
                        <label class="control-label" for="LawsuitClientInfo">Client Information </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('client_info', array('type'=>'textarea', 'class' => 'span6 typeahead', 'placeholder' => 'Client Information', 'error' => array(
                                'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="notCorp">Not a Corporate Client</label>
                    <div class="controls">
                        <?php
                        echo $this->Form->checkbox('not_corp', array(
                            'value' => true,
                            'hiddenField' => false,
                            'id' => 'notCorp'
                        ));
                        ?>
                    </div>
                </div>
                <div id="litigationExtraField">
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
                    <div class="control-group">
                        <label class="control-label" for="LawsuitBreakPoint">Appearing for</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('appearing_for', array('class' => 'span6 typeahead', 'placeholder' => 'Appearing for', 'error' => array(
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
                            'options' => array('0' => 'One time', '1' => 'Break in 2 periods', '2' => 'Break in 3 periods', 'no' => 'Cash Client'),
                            'data-rel' => 'chosen',
                            'class' => 'lawsuitBreakPoint'
                        ));
                        ?>
                    </div>
                </div>
                <div id="whenGenerateBill">
                    <div class="control-group">
                        <label class="control-label" for="LawsuitOpenClose">When generate the Invoice</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('open_close', array(
                                'options' => array(0 => 'Opening of the Case', 1 => 'Closing of the Case'),
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
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
                    <label class="control-label" for="LawsuitCreated">Received Date</label>
                    <div class="controls">
                        <input type="text" name="data[Lawsuit][created]" class="input-xlarge datepicker" id="LawsuitCreated"
                        <?php if (isset($this->data['Lawsuit']['created'])) {
                            echo 'value="' . $this->data['Lawsuit']['created'] . '"';
                        }
                        ?>
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
<?php if(isset($this->data['Lawsuit']['type']) && $this->data['Lawsuit']['type'] == 'litigation'): ?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#litigationExtraField').show();
    $('#litigationCaseTypeField').show();
    $('#litigationYearField').show();
    });
</script>
<?php endif; ?>
