<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php echo __('Case Timeline History'); ?></h2>
        </div>
        <div class="box-content">
            <div class="timeline">
                <?php
                $numberOfHistory = sizeof($timelineData);
                $i = 0;
                while ($i < $numberOfHistory){
//                    echo $timelineData[$i]['History']['reporting_date'];
                    $now = time();
                    $dead_line = strtotime($timelineData[$i]['History']['reporting_date']);
                    $datediff = $dead_line - $now;
                    $datediff = floor($datediff/(60*60*24));
                    if (($timelineData[$i]['History']['remark']=='' or $timelineData[$i]['History']['status'] == 'pending') and $datediff < 0) {
                        $make_it_red = true;
                        if ($i % 2 == 0) {
                            echo '<div class="timeslot" style="height: 124px;"><div class="task"><span style="border: 2px solid rgb(239, 7, 11);background: rgba(239, 45, 65, 0.31);"><span class="type">';
                        } else {
                            echo '<div class="timeslot alt" style="height: 124px;"><div class="task"><span style="border: 2px solid rgb(239, 7, 11);background: rgba(239, 45, 65, 0.31);"><span class="type">';
                        }
                    }else{
                        $make_it_red = false;
                        if ($i%2 == 0){
                            echo '<div class="timeslot" style="height: 124px;"><div class="task"><span><span class="type">';
                        }else{
                            echo '<div class="timeslot alt" style="height: 124px;"><div class="task"><span><span class="type">';
                        }
                    }
                    echo '</b>'.$timelineData[$i]['History']['title'].'</b></br>';
                    echo $timelineData[$i]['History']['court_name'];

                    echo '</span><span class="details">';

                    echo $timelineData[$i]['History']['description'];

                    echo '</span><span>';

                    echo $timelineData[$i]['History']['status'];

                    echo '<span class="remaining">';

                    echo $timelineData[$i]['History']['remark'];

                    echo '</span></span></span>';
                    if ($make_it_red){
                     echo '<div class="redarrow ">';
                    }else{
                        echo '<div class="arrow ">';
                    }
                    echo '</div></div><div class="icon"><i class="icon-calendar"></i></div><div class="time">';

                    echo date("d-m-Y", strtotime($timelineData[$i]['History']['reporting_date']));

                    echo '</div></div><div class="clearfix"></div>';

                    $i++;
                }
                ?>




            </div>
        </div>
    </div><!--/span-->

</div><!--/row-->

