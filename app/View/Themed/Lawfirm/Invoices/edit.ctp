<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white file"></i><span class="break"></span><?php echo __('Invoice of ') . $lawsuitInfo['Lawsuit']['number']; ?></h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white download-alt"></i></a>
<!--                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>-->
            </div>
        </div>
        <div class="box-content">
            <div class="page-header">
                <?php
                    $invoiceName = $lawsuitInfo['Lawsuit']['number'] . '-0' . $lawsuitInfo['Lawsuit']['invoice_period'] . '-' . date('d-m-y');
                    
                ?>
                <h2>Invoice # <small><?php echo $invoiceName; ?></small></h2>
            </div>
            <div class="page-header">
                <h2>Client Information : </h2>
                <h3><?php echo $lawsuitInfo['Client']['name']; ?></h3>
                <p><?php echo $lawsuitInfo['Client']['address']; ?></p>
                <p><?php echo $lawsuitInfo['Client']['contact_person']; ?></p>
                <p><?php echo $lawsuitInfo['Client']['phone']; ?></p>
            </div>
            <div class="page-header">
                <h3 style="text-align: center;">Description | amount</h3>
            </div>
            <?php
            echo $this->Form->create('Invoice', array(
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
                    <?php
                        echo $this->Form->hidden('name', array('value' => $invoiceName));
                        echo $this->Form->hidden('lawsuit_id', array('value' => $lawsuitInfo['Lawsuit']['id']));
                        echo $this->Form->hidden('client_id', array('value' => $lawsuitInfo['Client']['id']));
                        echo $this->Form->hidden('status', array('value' => 'unpaid'));
                    ?>
                    <div class="input_fields_wrap">
                        <button class="btn btn-primary add_field_button" title="Add new row"><i class="halflings-icon white white plus-sign"></i></button>
                        <div class="control-group">
                            <label class="control-label">Description | Amount</label>
                            <div class="controls">
                                <textarea name="data[Invoice][description][]"></textarea>
                                <div class="input-prepend input-append">
                                    <span class="add-on">TK</span><input name="data[Invoice][amount][]" step="any" type="number"><span class="add-on">.00</span>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="LawsuitSubject">Subject</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('subject', array('class' => 'span6 typeahead', 'placeholder' => 'Subject', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="LawsuitNote">Note</label>
                        <div class="controls">
                            <?php echo $this->Form->textarea('note', array('class'=>'cleditor')); ?>
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
