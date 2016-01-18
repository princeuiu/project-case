<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Edit Category'); ?></h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('Category', array(
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
                        <label class="control-label" for="CategoryParentId">Select Category</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('parent_id', array(
                                'options' => $parents,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="CategoryName">Name </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('name', array('class' => 'span6 typeahead', 'placeholder' => 'Category name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="CategoryStatus">Category Description</label>
                        <div class="controls">
                            <?php echo $this->Form->textarea('description', array('class'=>'cleditor')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="CategoryImage">Category Image</label>
                        <div class="controls">
                            <?php
                            if (isset($this->data["Category"]["image"]) && $this->data["Category"]["image"] && !is_array($this->data['Category']['image'])) {
                                echo $this->Html->image("categories/thumb/" . $this->data["Category"]["image"], array('class' => 'img-thumbnail'));
                                echo "<br />" . $this->Html->link("Remove Image", "/admin/categories/remove_image/" . $this->data["Category"]["image"]);
                            }
                            echo "<br /><br />";
                            echo $this->Form->file('image', array('class' => 'input-file uniform_on'));
                            ?>
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="CategoryStatus">Status</label>
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
