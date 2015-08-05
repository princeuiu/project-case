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
                    $title = $value['History']['title'];
                    $reporting_date = $value['History']['reporting_date'];
                    $id = $value['History']['id'];
                    echo "{ title : '".$title."',";
                    echo "start : '".$reporting_date."',";
                    echo "url : '".$url."'},";

                }
                ?>
            ]
        });

    }
</script>