<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Case Details'); ?></h2>
        </div>
        <div class="box-content">
            <?php
            echo 'Case Number : '.$this_case['Lawsuit']['number'].'</br>';
            echo 'Case Note : '.$this_case['Lawsuit']['note'].'</br>';
            echo 'Client : '.$this_case['Client']['name'].'</br>';
            echo 'Client Address : '.$this_case['Client']['address'].'</br>';
            echo 'Client Contact Person : '.$this_case['Client']['contact_person'].'</br>';
            echo 'Client Contact Number : '.$this_case['Client']['phone'].'</br>';
            echo 'Case Opened : '.$this->Time->format($this_case['Lawsuit']['created'], '%B %e, %Y');
            ?>
        </div>
    </div><!--/span-->
</div>
<div class="row-fluid sortable">
    <div class="box span6">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Case History'); ?></h2>
            <!--            <div class="box-icon">

                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
        </div>
        <div class="box-content">
            <?php
            //            echo $histories[0]['History']['title'];
            ////            echo $histories[1]['History']['title'];
            foreach($histories as $history){

                echo '<div class="box span12" style="margin-left: 0px;"><div class="box-header"><h2><i class="halflings-icon white white tasks"></i><span class="break"></span>';
                echo $history['History']['title'] ;
//                echo '<a href="/histories/view/' .$history['History']['id']. '">' . $history['History']['title'] . '</a>';
                echo '</h2><div class="box-icon"><a href="/histories/view/' .$history['History']['id']. '"><i class="halflings-icon white eye-open"></i></a><a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>';
                echo'</div></div><div class="box-content">';
                echo '<b>Name of the Court : ' .$history['History']['court_name'] . '</b></br>';
                echo 'Description : ' .$history['History']['description'] . '</br>';
                echo 'Reporting Date : ' .$history['History']['reporting_date'] . '</br>';
                echo 'Created : ' .$history['History']['created'] . '</br>';
                echo 'remark : ' .$history['History']['remark'] . '</br>';
                echo'</div></div>';
            }
            ?>
        </div>
    </div><!--/span-->

    <div class="box span6">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Case Task History'); ?></h2>
            <!--            <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>-->
        </div>
        <div class="box-content">
            <?php
            foreach($this_case_task as $this_task){

                echo '<div class="box span12" style="margin-left: 0px;"><div class="box-header"><h2><i class="halflings-icon white white tasks"></i><span class="break"></span>';
                echo $this_task['Tasklist']['name'];
//                echo '<a href="/tasks/details/' .$this_task['Task']['id']. '">' . $this_task['Task']['name'] . '</a>';
                echo '</h2><div class="box-icon"><a href="#" title="Upload Office Copy" class="officeFileUploadBtn" data-toggle="modal" data-target="#modalOfficeCopy" data-taskid = "' .$this_task['Task']['id']. '" data-caseid = "' .$this_case['Lawsuit']['id']. '"><i class="halflings-icon white upload"></i></a><a href="/tasks/details/' .$this_task['Task']['id']. '"><i class="halflings-icon white eye-open"></i></a><a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>';
                echo'</div></div><div class="box-content">';
                echo 'Description : ' .$this_task['Task']['description'] . '</br>';
                echo 'Dead Line : ' .$this_task['Task']['dead_line'] . '</br>';
                echo 'Status : ' .$this_task['Task']['status'] . '</br>';
                echo 'Created : ' .$this_task['Task']['created'] . '</br>';
                echo 'Created By : ' .$this_task['Owner']['name'] . '</br>';
                echo 'Assigned To : ' .$this_task['Assigned']['name'] . '</br>';
                foreach($task_files as $task_file){
                    if($this_task['Task']['id'] == $task_file['Task']['id']){
                        echo 'Task output file : <i class="icon-paper-clip"></i>&nbsp;&nbsp;<a href="/uploads/doc/' . $task_file['WantingDoc']['name'] . '" target="_blank" ><i class="fa fa-paperclip"></i>'. $task_file['WantingDoc']['name'] .'</a></br>';
                    }
                }
                foreach($taskOfficeCopies as $taskOfficeCopy){
//                    print_r($taskOfficeCopy); die;
                    if($this_task['Task']['id'] == $taskOfficeCopy['Task']['id']){
                        echo 'Office Copy : <i class="icon-paper-clip"></i>&nbsp;&nbsp;<a href="/uploads/doc/' . $taskOfficeCopy['WantingDoc']['name'] . '" target="_blank" ><i class="fa fa-paperclip"></i>'. $taskOfficeCopy['WantingDoc']['name'] .'</a></br>';
                    }
                }
                echo'</div></div>';
            }

            ?>
        </div>
        
        <!-- Modal -->
        <div id="modalOfficeCopy" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo __('Form upload Office copy.'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Upload Office copy.'); ?></h2>
                            </div>
                            <div class="box-content">
                                <?php
                                echo $this->Form->create('TaskComments', array(
                                    'action' => 'add_office_file',
                                    'class' => 'form-horizontal',
                                    'type' => 'file',
                                    'id' => 'addOfficeFile',
                                    'inputDefaults' => array(
                                        'div' => false,
                                        'label' => false
                                    )
                                ));
                                ?>
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label" for="TaskCommentsFiles">Upload office copy </label>
                                        <div class="controls">
                                            <?php
                                                echo $this->Form->input('files', array('type' => 'file'));
                                                echo $this->Form->input('lawsuit_id', array('type' => 'hidden', 'id'=>'modalCaseId'));
                                                echo $this->Form->input('task_id', array('type' => 'hidden', 'id'=>'modalTaskId'));
                                            ?>
                                        </div>
                                    </div>
                                </fieldset>
                                </form>   

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submit-office-upload-file">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div><!--/span-->

</div><!--/row-->
