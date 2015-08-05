<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>
                <?php
                echo $lawsuitNumber;
                ?>
            </h2>
            <div class="box-icon">
                <?php
                echo '<a href="/histories/edit/'.$id.'"><i class="halflings-icon white wrench"></i></a>';
                ?>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>
                        <b>
                            History Title
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['History']['title']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            History Description
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['History']['description']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Reporting Date
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['History']['reporting_date']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Status
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['History']['status']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Case Number
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['Lawsuit']['number']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Client Name
                        </b>
                    </td>
                    <td><?php
                        echo ($clientInfo['Client']['name']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Client Contact Person
                        </b>
                    </td>
                    <td><?php
                        echo ($clientInfo['Client']['contact_person']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Client Contact Number
                        </b>
                    </td>
                    <td><?php
                        echo ($clientInfo['Client']['phone']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Note
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['Lawsuit']['note']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Case Status
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['Lawsuit']['status']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Case Type
                        </b>
                    </td>
                    <td><?php
                        echo ($historyData['Lawsuit']['type']);
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
<!--            <div class="pagination pagination-centered">-->
<!--                <ul>-->
<!--                    <li><a href="#">Prev</a></li>-->
<!--                    <li class="active">-->
<!--                        <a href="#">1</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">2</a></li>-->
<!--                    <li><a href="#">3</a></li>-->
<!--                    <li><a href="#">4</a></li>-->
<!--                    <li><a href="#">Next</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>

</div><!--/row-->

