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
                echo $this->Form->hidden('lawsuit_invoice_period', array('value' => $lawsuitInfo['Lawsuit']['invoice_period']));
                ?>

                <div class="page-header">
                    <h3 style="text-align: center;">Fixed costs | Qty</h3>
                </div>
                <div class="fixed_input_fields_wrap">
                    <button class="btn btn-primary fixed_add_field_button" title="Add new row"><i class="halflings-icon white white plus-sign"></i></button>
                    <div class="control-group">
                        <label class="control-label">Fixed costs | Qty</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('cost_id', array(
                                'options' => $costList,
                                'name' => 'data[Invoice][cost_id][]'
                            ));
                            ?>
                            <div class="input-prepend input-append">
                                <input name="data[Invoice][cost_qty][]" step="any" type="number">
                            </div>                            
                        </div>
                    </div>
                </div>
                
                
                <div class="page-header">
                    <h3 style="text-align: center;">Actual costs | amount</h3>
                </div>
                <div class="variable_input_fields_wrap">
                    <button class="btn btn-primary variable_add_field_button" title="Add new row"><i class="halflings-icon white white plus-sign"></i></button>
                    <div class="control-group">
                        <label class="control-label">Description | Amount</label>
                        <div class="controls">
                            <textarea name="data[Invoice][v_cost][]"></textarea>
                            <div class="input-prepend input-append">
                                <span class="add-on">TK</span><input name="data[Invoice][v_amount][]" step="any" type="number"><span class="add-on">.00</span>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="page-header">
                    <h3 style="text-align: center;">Professional fees | amount</h3>
                </div>
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
                <div class="page-header">
                    <h3 style="text-align: center;">Others</h3>
                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitVat">VAT</label>
                    <div class="controls">
                            <div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" name="data[Invoice][vat]" id="inlineCheckbox1" value="true"></span></div>
<!--                        <div class="input-prepend input-append">
                            <input name="data[Invoice][vat]" step="any" type="number"><span class="add-on">&percnt;</span>
                        </div>-->
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="LawsuitTax">Income Tax</label>
                    <div class="controls">
                            <div class="checker" id="uniform-inlineCheckbox2"><span class=""><input type="checkbox" name="data[Invoice][tax]" id="inlineCheckbox2" value="true"></span></div>
<!--                        <div class="input-prepend input-append">
                            <input name="data[Invoice][tax]" step="any" type="number"><span class="add-on">&percnt;</span>
                        </div>-->
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
                        <?php
                        echo $this->Form->input('note', array('class' => 'span6 typeahead', 'placeholder' => 'Note', 'error' => array(
                                'attributes' => array('escape' => false)
                        )));
                        ?>
                        <?php //echo $this->Form->textarea('note', array('class'=>'cleditor')); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" name="btnPrintPDF">Save and Print PDF</button>
                    <button type="submit" class="btn btn-primary" name="btnSaveInv">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div><!--/span-->

</div><!--/row-->