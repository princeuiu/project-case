<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Edit Currency'); ?></h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('Currency', array(
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
                        <label class="control-label" for="CurrencyName">Name </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('name', array('class' => 'span6 typeahead', 'placeholder' => 'Currency name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="CurrencySymbol">Currency Symbol </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('symbol', array('class' => 'span6 typeahead', 'placeholder' => 'Currency Symbol', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>   
                    <div class="control-group">
                        <label class="control-label" for="CurrencyStatus">Status</label>
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
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->

