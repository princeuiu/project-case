<!-- popup -->
<div class="modal fade" id="ratingSuccessModal" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-submit" data-dismiss="modal">Ok</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div id="ajaxMsg">
        </div>
    </div>
</div>
<?php 
$itemCount = count($items);
$queCount = count($questions); ?>
<script type="text/javascript">var itemCount = "<?php echo $itemCount; ?>";</script>
<script type="text/javascript">var queCount = "<?php echo $queCount; ?>";</script>
<?php
$rowCount = 1;
foreach($items as $item):  
    //pr($item);
    if($rowCount % 2 != 0):
?>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-4">
            <?php echo $this->Html->image("items/resize/".$item["Item"]["image"], array('class' => 'img-responsive')); ?>
            <div class="employee-name mg-btm-20"><p><?php echo $item['Item']['name']; ?></p></div>
            <input type="hidden" id="item-count-<?php echo $rowCount; ?>" value="<?php echo $item['Item']['id']; ?>" />
        </div>
        <div class="col-sm-6 col-md-8 col-lg-8">
            <table class="table table-hover">
            <?php
                $count = 0;
                foreach($questions as $question): 
                    $count++;
            ?>
                <tr>
                    <td class="col-sm-6 col-md-6 col-lg-8">
                        <p><?php echo __($count); echo ') ' .  $question['Question']['question']?></p>
                    </td>
                    <td class="col-sm-6 col-md-6 col-lg-4"><input id="input-<?php echo $rowCount; ?>-<?php echo $count; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-lft="true"></td>
                </tr>
            <?php
                endforeach;
            ?>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                        <label for="ratingComment" class="col-sm-2 control-label rating-label">Comment</label>
                        <?php echo $this->Form->input('comment', array('placeholder' => 'Your comment is valuable to us.', 'label'=>false, 'div'=>array('class'=>'col-md-6'), 'class'=>'form-control input-style-custom', 'id'=>'ratingComment-'.$rowCount, 'type'=>'textarea'
                    )); ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<?php
    else:
?>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-4 rating-con-flt-rht">
            <?php echo $this->Html->image("items/resize/".$item["Item"]["image"], array('class' => 'img-responsive')); ?>
            <div class="employee-name mg-btm-20"><p><?php echo $item['Item']['name']; ?></p></div>
            <input type="hidden" id="item-count-<?php echo $rowCount; ?>" value="<?php echo $item['Item']['id']; ?>" />
        </div>
        <div class="col-sm-6 col-md-8 col-lg-8 rating-con-flt-lft">
            <table class="table table-hover">
            <?php
                $count = 0;
                foreach($questions as $question): 
                    $count++;
            ?>
                <tr>
                    <td class="col-sm-6 col-md-6 col-lg-8">
                        <p><?php echo __($count); echo ') ' .  $question['Question']['question']?></p>
                    </td>
                    <td class="col-sm-6 col-md-6 col-lg-4"><input id="input-<?php echo $rowCount; ?>-<?php echo $count; ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-lft="true"></td>
                </tr>
            <?php
                endforeach;
            ?>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                        <label for="ratingComment" class="col-sm-2 control-label rating-label">Comment</label>
                        <?php echo $this->Form->input('comment', array('placeholder' => 'Your comment is valuable to us.', 'label'=>false, 'div'=>array('class'=>'col-md-6'), 'class'=>'form-control input-style-custom', 'id'=>'ratingComment-'.$rowCount, 'type'=>'textarea'
                    )); ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<?php
    endif;
?>
<!--    <hr />-->
<?php
    $rowCount++;
endforeach;
?>

  <div class="row">
    <div class="col-md-6 col-md-offset-6">
        <div class="form-group">
            <label for="ratingUserEmail" class="col-sm-2 control-label rating-label">Email</label>
            <?php echo $this->Form->input('email', array('placeholder' => 'Enter your email id (Not required)', 'label'=>false, 'div'=>array('class'=>'col-md-6'), 'class'=>'form-control input-style-custom', 'id'=>'ratingUserEmail'
            )); ?>
        </div>
        <button type="button" class="btn btn-primary btn-submit btn-lg btn-xlarge mg-btm-20 mg-top-20" id="rate">
            Submit Ratting
        </button>
    </div>
  </div>


