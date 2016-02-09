<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <h2 class="txt-align-center mg-btm-20"><?php echo __('Review on '.$itemData['Item']['name']); ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-5 col-lg-4">
        <?php echo $this->Html->image("items/resize/".$itemData["Item"]["image"], array('class' => 'img-responsive border-radious-10 img-align-center mg-btm-20')); ?>
    </div>
    <div class="col-sm-6 col-md-7 col-lg-8">
        <table class="table table-hover">
            <tr>
                <td colspan="2">
                    <input id="input-1" value="<?php echo $itemData['Item']['rating'] ?>" type="number" class="rating" showClear="false" min=0 max=5 step=1 data-size="sm" disabled="true" readonly="true">
                </td>
            </tr>
            <tr>
                <td><?php echo __('Name'); ?></td>
                <td><?php echo $itemData['Item']['name']; ?></td>
            </tr>
            <tr>
                <td><?php echo __('Region'); ?></td>
                <td><?php echo $itemData['Region']['name']; ?></td>
            </tr>
            <tr>
                <td><?php echo __('Category'); ?></td>
                <td><?php echo $itemData['Category']['name']; ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <h3>Rating Given By Our Clients</h3>
    </div>
</div>
<?php $cont = ""; ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div role="tabpanel">
            
            <ul class="nav nav-tabs" role="tablist" id="ratingDetail">
                <li role="presentation" class="active">
                    <a href="#today" aria-controls="today" role="tab" data-toggle="tab">Today</a>
                </li>
                <li role="presentation" class="<?php if($cont == 'employees'){ echo ' active';} ?>">
                    <a href="#lastDay" aria-controls="lastDay" role="tab" data-toggle="tab">Last day</a>
                </li>
                <li role="presentation" class="<?php if($cont == 'employees'){ echo ' active';} ?>">
                    <a href="#last7Day" aria-controls="last7Day" role="tab" data-toggle="tab">Last 7 days</a>
                </li>
                <li role="presentation" class="<?php if($cont == 'employees'){ echo ' active';} ?>">
                    <a href="#lastMonth" aria-controls="lastMonth" role="tab" data-toggle="tab">Last month</a>
                </li>
                <li role="presentation" class="<?php if($cont == 'employees'){ echo ' active';} ?>">
                    <a href="#last6Month" aria-controls="last6Month" role="tab" data-toggle="tab">Last 6 months</a>
                </li>
                <li role="presentation" class="<?php if($cont == 'employees'){ echo ' active';} ?>">
                    <a href="#last12Month" aria-controls="last12Month" role="tab" data-toggle="tab">Last 12 months</a>
                </li>
            </ul>
            
            
            <div class="tab-content mg-top-20">
                <div role="tabpanel" class="tab-pane active" id="today">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataToDay) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataToDay as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="charttoday" style="height: 250px;"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Today's Chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    dataPoints: [
                                                        <?php foreach($dataToDay as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#charttoday").CanvasJSChart(options);

                            });
                        </script>
<!--                        <script type="text/javascript">
                            new Morris.Area({
                          // ID of the element in which to draw the chart.
                          element: 'charttoday',
                          // Chart data records -- each entry in this array corresponds to a point on
                          // the chart.
                          data: [
                          <?php //$count = 0; foreach($dataLastYear as $eachRating): ?>
                            { date: '<?php //echo $eachRating['Rateing']['created']; ?>', value: <?php //echo floatval($eachRating['Rateing']['rateing']); ?> },
                          <?php //$count++; endforeach; ?>
                          ],
                          // The name of the data record attribute that contains x-values.
                          xkey: 'date',
                          // A list of names of data record attributes that contain y-values.
                          ykeys: ['value'],
                          // Labels for the ykeys -- will be displayed when you hover over the
                          // chart.
                          labels: ['Value'],
                          lineColors: ['#f37021']
                        });
                        </script>-->
                    </div>
                </div>
                <div role="tabpanel"class="tab-pane" id="lastDay">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataLastDay) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataLastDay as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="chartlastday" style="height: 250px;"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Last Day's chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    dataPoints: [
                                                        <?php foreach($dataLastDay as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#chartlastday").CanvasJSChart(options);

                            });
                        </script>
<!--                        <script type="text/javascript">
                            new Morris.Line({
                          // ID of the element in which to draw the chart.
                          element: 'chartlastday',
                          // Chart data records -- each entry in this array corresponds to a point on
                          // the chart.
                          data: [
                          <?php //$countt = 0; foreach($dataLastDay as $eachRatingLastDay): ?>
                            { date: '<?php //echo $eachRating['Rateing']['created']; ?>', value: <?php //echo floatval($eachRatingLastDay['Rateing']['rateing']); ?> },
                          <?php //$countt++; endforeach; ?>
                          ],
                          // The name of the data record attribute that contains x-values.
                          xkey: 'date',
                          // A list of names of data record attributes that contain y-values.
                          ykeys: ['value'],
                          // Labels for the ykeys -- will be displayed when you hover over the
                          // chart.
                          labels: ['value'],
                          lineColors: ['#f37021']
                        });
                        </script>-->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="last7Day">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataLastWeek) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataLastWeek as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="chartlastweek" style="height: 250px;"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Last Week's chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    dataPoints: [
                                                        <?php foreach($dataLastWeek as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#chartlastweek").CanvasJSChart(options);

                            });
                        </script>
<!--                        <script  type="text/javascript">
                            new Morris.Line({
                          // ID of the element in which to draw the chart.
                          element: 'chartlastweek',
                          // Chart data records -- each entry in this array corresponds to a point on
                          // the chart.
                          data: [
                          <?php //$countt = 0; foreach($dataLastWeek as $eachRatingLastDay): ?>
                            { date: '<?php //echo $eachRating['Rateing']['created']; ?>', value: <?php //echo floatval($eachRatingLastDay['Rateing']['rateing']); ?> },
                          <?php //$countt++; endforeach; ?>
                          ],
                          // The name of the data record attribute that contains x-values.
                          xkey: 'date',
                          // A list of names of data record attributes that contain y-values.
                          ykeys: ['value'],
                          // Labels for the ykeys -- will be displayed when you hover over the
                          // chart.
                          labels: ['value'],
                          lineColors: ['#f37021']
                        });
                        </script>-->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="lastMonth">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataLastMonth) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataLastMonth as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="chartlastmonth" style="height: 250px; width: 90%"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Last Month's chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    markerSize: 10,
                                                    dataPoints: [
                                                        <?php foreach($dataLastMonth as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#chartlastmonth").CanvasJSChart(options);

                            });
                        </script>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="last6Month">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataLastSixMonth) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataLastSixMonth as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="chartlastmonth" style="height: 250px; width: 90%"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Last Month's chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    markerSize: 10,
                                                    dataPoints: [
                                                        <?php foreach($dataLastMonth as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#chartlastmonth").CanvasJSChart(options);

                            });
                        </script>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="last12Month">
                    <div class="row">
                        <div class="col-sm-6 col-md-7 col-lg-8 border-right">
                            <?php if(count($dataLastYear) != 0): ?>
                            <table class="table table-hover table-ratingDetail mg-top-20">
                                <tr>
                                    <th>
                                        <?php echo __('Client\'s Email id'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Rating'); ?>
                                    </th>
                                    <th>
                                        <?php echo __('Comment'); ?>
                                    </th>
                                </tr>
                                <?php
                                    foreach($dataLastYear as $eachRating):
                                ?>
                                <tr>
                                    <td>
                                        <?php if($eachRating['Rateing']['email'] != null){ echo $eachRating['Rateing']['email']; }else{ echo 'Anonymous Client';} ?>
                                    </td>
                                    <td>
                                        <input id="input-2" value="<?php echo $eachRating['Rateing']['rateing'] ?>" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-disabled="true" data-readonly="true" data-clear="false" data-caption="false">
                                    </td>
                                    <td>
                                        <?php echo $eachRating['Rateing']['comment']; ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </table>
                            <?php else: ?>
                            <div class="alert alert-info" role="alert">No record to show!</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-4">
                            <div id="chartlastmonth" style="height: 250px; width: 90%"></div>
                        </div>
                        <script type="text/javascript">
                            $(function () {

                                    //Better to construct options first and then pass it as a parameter
                                    var options = {
                                            animationEnabled: true,
                                            title: {
                                                    text: "Last Month's chart"
                                            },
                                            data: [
                                            {
                                                    type: "splineArea", //change it to line, area, bar, pie, etc
                                                    color: "rgba(243,112,32,.7)",
                                                    markerSize: 10,
                                                    dataPoints: [
                                                        <?php foreach($dataLastMonth as $eachRating): ?>
                                                            { y: <?php echo floatval($eachRating['Rateing']['rateing']); ?> },
                                                        <?php endforeach; ?>
                                                    ]
                                            }
                                            ]
                                    };

                                    //$("#chartlastmonth").CanvasJSChart(options);

                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .clear-rating{
        display: none !important;
    }
    .caption{
        display: none !important;
    }
</style>

