<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Edit Item'); ?></h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('Item', array(
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
                        <label class="control-label" for="ItemCategoryId">Select Category</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('category_id', array(
                                'options' => $categories,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemBrandId">Select Brand</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('brand_id', array(
                                'options' => $brands,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemName">Name </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('name', array('class' => 'span6 typeahead', 'placeholder' => 'Item name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="ItemStatus">Item Description</label>
                        <div class="controls">
                            <?php echo $this->Form->textarea('description', array('class'=>'cleditor')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemImage">Item Image</label>
                        <div class="controls">
                            <?php
                            if (isset($this->data["Item"]["image"]) && $this->data["Item"]["image"] && !is_array($this->data['Item']['image'])) {
                                echo $this->Html->image("items/thumb/" . $this->data["Item"]["image"], array('class' => 'img-thumbnail'));
                                echo "<br />" . $this->Html->link("Remove Image", "/admin/items/remove_image/" . $this->data["Item"]["image"]);
                            }
                            echo "<br /><br />";
                            echo $this->Form->file('image', array('class' => 'input-file uniform_on'));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemSupplierId">Select Supplier</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('supplier_id', array(
                                'options' => $suppliers,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemUnitId">Select Unit</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('unit_id', array(
                                'options' => $units,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemUnitPrice">Unit Price </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('unit_price', array('class' => 'span6 typeahead', 'placeholder' => 'Unit Price', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemCurrencyId">Currency</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('currency_id', array(
                                'options' => $currencies,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ItemStatus">Status</label>
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
