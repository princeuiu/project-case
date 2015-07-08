<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Form Add/Update Task'); ?></h2>
<!--            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>-->
        </div>
        <div class="box-content">
            <?php
            echo $this->Form->create('Task', array(
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
                        <label class="control-label" for="TaskLawsuitId">Task Under Case</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('lawsuit_id', array(
                                'options' => $lawsuits,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="TaskName">Name </label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('name', array('class' => 'span6 typeahead', 'placeholder' => 'Task name', 'error' => array(
                                    'attributes' => array('escape' => false)
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="LawsuitDescription">Note</label>
                        <div class="controls">
                            <?php echo $this->Form->textarea('description', array('class'=>'cleditor')); ?>
                        </div>
                    </div>
                    <input name="data[Task][owner]" id="TaskOwner" type="hidden" value="<?php echo $loggedinId; ?>" />
                    <div class="control-group">
                        <label class="control-label" for="TaskAssignedTo">Task Assigned To</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('assigned_to', array(
                                'options' => $users,
                                'data-rel' => 'chosen'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="TaskFollower">Task followers</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->select('follower',$users,array(
                                'multiple'=>true,
                                'data-rel' => 'chosen',
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox inline">
                            <?php
                            echo $this->Form->checkbox('wanting_doc', array('hiddenField' => false));
                            ?>
                                Wanting Document
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="TaskDeadLine">Dead Line</label>
                        <div class="controls">
                            <input type="text" name="data[Task][dead_line]" class="input-xlarge datepicker" id="TaskDeadLine" <?php if(isset($this->data['Task']['dead_line'])){ echo 'value="' . $this->data['Task']['dead_line'] . '"';} ?>>
                            <?php
//                            echo $this->Form->input('dead_line', array(
//                                'class' => 'input-xlarge datepicker',
//                                'value' => '01/07/15'
//                            ));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="TaskStatus">Status</label>
                        <div class="controls">
                            <?php
                            echo $this->Form->select('status',
                                array('pending' => 'Pending','done' => 'Done'),
                                array('data-rel' => 'chosen')
                            );
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

