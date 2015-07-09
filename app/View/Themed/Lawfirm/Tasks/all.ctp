<div class="row-fluid">

    <div class="span9">
        <h1>Tasks</h1>
        
    <?php
        foreach($tasks as $task):
            if($task['Task']['datediff'] < 4):
            ?>
                <div class="priority high"><span>high priority</span></div>
                    <div class="task high">
            <?php
            elseif($task['Task']['datediff'] > 3 &&  $task['Task']['datediff'] < 11):
            ?>
                <div class="priority medium"><span>medium priority</span></div>
                    <div class="task medium">
            <?php
            elseif($task['Task']['datediff'] > 10):
            ?>
                <div class="priority low"><span>low priority</span></div>
                    <div class="task low">
            <?php
            endif;
        ?>
            
            
                <div class="desc">
                    <div class="title"><?php echo $task['Task']['name']; ?></div>
                    <div><?php echo $task['Task']['description']; ?></div>
                </div>
                <div class="time">
                    <div class="date"><?php echo $this->Time->format($task['Task']['dead_line'], '%B %e, %Y'); ?></div>
                    <div><?php echo $task['Task']['datediff']; ?> day(s)</div>
                </div>
            </div>
        <?php
        endforeach;
    ?>

        
        <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <ul class="list-inline item-details">
                    <li><a href="http://themifycloud.com">Admin templates</a></li>
                    <li><a href="http://themescloud.org">Bootstrap themes</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>		

    </div>
<!--
    <div class="span5 noMarginLeft">

        <div class="dark">

            <h1>Timeline</h1>

            <div class="timeline">

                <div class="timeslot">

                    <div class="task">
                        <span>
                            <span class="type">appointment</span>
                            <span class="details">
                                Dennis Ji at Bootstrap Metro Dashboard HQ
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>							
                    <div class="icon">
                        <i class="icon-map-marker"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="clearfix"></div>

                <div class="timeslot alt">

                    <div class="task">
                        <span>
                            <span class="type">phone call</span>
                            <span class="details">
                                Dennis Ji
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span>
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-phone"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot">

                    <div class="task">
                        <span>
                            <span class="type">mail</span>
                            <span class="details">
                                Dennis Ji
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot alt">

                    <div class="task">
                        <span>
                            <span class="type">deadline</span>
                            <span class="details">
                                Fixed bugs
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-calendar"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot">

                    <div class="task">
                        <span>
                            <span class="type">appointment</span>
                            <span class="details">
                                Dennis Ji at Bootstrap Metro Dashboard HQ
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>							
                    <div class="icon">
                        <i class="icon-map-marker"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="clearfix"></div>

                <div class="timeslot alt">

                    <div class="task">
                        <span>
                            <span class="type">skype call</span>
                            <span class="details">
                                Dennis Ji
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span>
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-phone"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot">

                    <div class="task">
                        <span>
                            <span class="type">mail</span>
                            <span class="details">
                                Dennis Ji
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot alt">

                    <div class="task">
                        <span>
                            <span class="type">project deadline</span>
                            <span class="details">
                                Fixed bugs
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-calendar"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

                <div class="timeslot">

                    <div class="task">
                        <span>
                            <span class="type">mail</span>
                            <span class="details">
                                Dennis Ji
                            </span>
                            <span>
                                remaining time
                                <span class="remaining">
                                    3h 38m 15s
                                </span>	
                            </span> 
                        </span>
                        <div class="arrow"></div>
                    </div>
                    <div class="icon">
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="time">
                        3:43 PM
                    </div>	

                </div>

            </div>
        </div>

    </div>	
-->
</div>