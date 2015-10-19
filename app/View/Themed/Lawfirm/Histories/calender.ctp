<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white calendar"></i><span class="break"></span>Calendar</h2>
        </div>
        <div class="box-content">
            <div id="calendar" class="span12"></div>

            <div class="clearfix"></div>
        </div>
    </div>
</div><!--/row-->

<script type="text/javascript">
    function calendars(){
        $('#calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'prev,next today,month,agendaWeek,agendaDay'
            },
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            events: [
                <?php
//                print_r($histories);
                $arr = $histories;

                foreach ($arr as $value) {
                    $url = $this->Html->url('/histories/view/' . $value['History']['id'], true);
//                    $title = $value['History']['title'];
                    $title = $value['Lawsuit']['number'];
                    $reporting_date = $value['History']['reporting_date'];
                    $reporting_date_str = strtotime($value['History']['reporting_date']);
                    $id = $value['History']['id'];
                    $now = time();
                    $datediff = $reporting_date_str - $now;
                    $datediff = floor($datediff/(60*60*24));

                    if ($value['History']['remark']=='' and $datediff < 0){
                        echo "{ title : '".$title."',";
                        echo "start : '".$reporting_date."',";
                        echo "color : 'red',";
                        echo "url : '".$url."'},";
                    }else{
                    echo "{ title : '".$title."',";
                        echo "start : '".$reporting_date."',";
                        echo "url : '".$url."'},";

                    }
                }
                ?>
            ]
        });

    }
</script>