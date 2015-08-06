<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Case Details'); ?></h2>
        </div>
        <div class="box-content">
            <?php
            echo 'Name : '.$items['User']['name'].'</br>';
            echo 'Email : '.$items['User']['email'].'</br>';
            echo 'Role : '.$items['User']['role'].'</br>';
            echo 'Status : '.$items['User']['status'].'</br>';
            echo 'Joined : '.$this->Time->format($items['User']['created'], '%B %e, %Y').'</br>';
            echo 'Tasks Owned : '.count($items['TaskOwner']).'</br>';
            echo 'Tasks Assigned : '.count($items['TaskAssigned']).'</br>';
            echo 'Tasks Following : '.count($items['TaskFollower']).'</br>';

            ?>
        </div>
    </div><!--/span-->
</div>