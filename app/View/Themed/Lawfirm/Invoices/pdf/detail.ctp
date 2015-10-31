<?php
$page_width = '950px';
$normal_font_size = '16px';
$smaller_font_size = '11px';

$page_background_color = '#fff';
$dark_font_color = '#000';
$light_font_color = '#777';

$title_row_font_color = '#fff';
$title_row_background_color = '#000';

$odd_row_color = '#fff';
$even_row_color = '#ddd';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <style type="text/css">
            body {
                margin: 18pt 18pt 24pt 18pt;
            }

            * {
                font-family: helvetica,georgia,serif;

            }



            p {
                text-align: justify;
                font-size: 1em;
                margin: 0.5em;
                padding: 10px;
            }
            .subjectText{
                text-align: justify;
                font-size: 1em;
                margin: 0;
                margin-right: 300px;
                padding: 0;
                line-height: 2em;
            }
            .log td,.log th,.dataTable td,.dataTable th{
                border:1px solid;
                padding:5px;
            }

            .log,.dataTable{
                font-size:12px;
            }

            #pdf .nodisplay{
                display:none;
            }
            #pdf .log,#pdf .dataTable{
                width: 70%;
                margin-bottom:30px;
            }
            #pdf .log .last,#pdf .dataTable .last{
                display: none;
            }
            #pdf .summary{
                font:bold 18px arial;
                margin:10px 0;

            }

            #pdf strong{
                font:bold 18px arial;
                color:#000;
            }
            #pdf b{
                font:bold 18px arial;
                text-decoration: underline;
                color:#000;
            }
            #pdf span{
                font:normal 18px arial;
                color:#000;
            }
        </style>
    </head>
    <body id="pdf" style="width: 80%">
        <div style="
             width:<?php echo $page_width ?>; 
             margin:auto; 
             font-family:helvetica; 
             background-color:<?php echo $page_background_color ?>; 
             font-size:<?php echo $normal_font_size ?>; 
             color:<?php echo $dark_font_color ?>
             ">
            <span>Ref: <?php echo $invoiceData['Invoice']['slug'] ?></span><br /><br />
            <span><?php echo date("F j, Y"); ?></span><br /><br />

            <span><?php echo $invoiceData['Client']['contact_person']; ?></span><br />
            <span><?php echo $invoiceData['Client']['person_designation']; ?></span><br />
            <span><?php echo $invoiceData['Client']['name']; ?></span><br />
            <span><?php echo $invoiceData['Client']['address']; ?></span><br /><br />

            <p class="subjectText"><strong>Sub: <b><?php echo $invoiceData['Invoice']['subject']; ?></b></strong><br /><br /><br /></p>

            <table class="dataTable">
                <tr>
                    <th style="text-align: center;">Sl. No</th>
                    <th style="text-align: center">Particulars</th>
                    <th style="text-align: center">Amount in<br />BDT</th>
<!--                    <th style="text-align: center">Deduction</th>
                    <th style="text-align: center">Net Bill</th>-->
                </tr>
                <?php
                $count = 1;
                foreach ($descriptions as $eachDesc):
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $count; ?></td>
                        <td style="text-align: left;"><?php echo $eachDesc['desc']; ?></td>
                        <td style="text-align: center;"><?php echo $eachDesc['amount']; ?></td>
    <!--                    <td style="text-align: center;"></td>
                        <td style="text-align: center;"></td>-->
                    </tr>
                    <?php
                    $count++;
                endforeach;
                if (!empty($invoiceData['Invoice']['vat']) && $invoiceData['Invoice']['vat'] != 0):
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $count; ?></td>
                        <td style="text-align: left;">VAT (<?php echo $invoiceData['Invoice']['vat']; ?>&percnt; as per General Order No. 07/Musak/2012)</td>
                        <td style="text-align: center;"><?php echo $invoiceData['Invoice']['vat_amount']; ?></td>
                    </tr>
                    <?php
                    $count++;
                endif;
                ?>
                <tr>
                    <td style="text-align: right;"  colspan="2"><strong>Total Professional Fees</strong></td>
                    <td style="text-align: center;"><?php echo $invoiceData['Invoice']['amount']; ?></td>
                </tr>
                <?php
                if (!empty($fCosts) || !empty($vCosts)):
                    ?>
                    <tr>
                        <td style="text-align: center;"  colspan="3">
                            <strong>Actual Cost</strong>
                        </td>
                    </tr>
                    <?php
                    if (!empty($fCosts)):
                        ?>
                        <tr>
                            <td style="text-align: right;"  colspan="2">
                                <?php
                                foreach ($fCosts as $eachFCost):
                                    ?>
                                    <?php echo $eachFCost['name']; ?> X <?php echo $eachFCost['qty']; ?><br/>
                                    <?php
                                endforeach;
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $invoiceData['Invoice']['f_amount']; ?></td>
                        </tr>
                        <?php
                    endif;
                    ?>
                    <?php
                    if (!empty($vCosts)):
                        ?>
                        <tr>
                            <td style="text-align: right;"  colspan="2">
                                <?php
                                foreach ($vCosts as $eachVCost):
                                    ?>
                                    <?php echo $eachVCost['vCost']; ?><br/>
                                    <?php
                                endforeach;
                                ?>
                            </td>
                            <td style="text-align: center;"><?php echo $invoiceData['Invoice']['v_amount']; ?></td>
                        </tr>
                        <?php
                    endif;
                    ?>
                    <?php
                endif;
                ?>
                <tr>
                    <td style="text-align: right;"  colspan="2"><strong>Total</strong></td>
                    <td style="text-align: center;"><?php echo $invoiceData['Invoice']['total_amount']; ?></td>
                </tr>
                <?php
                if ((!empty($invoiceData['Invoice']['vat']) && $invoiceData['Invoice']['vat'] != 0) || (!empty($invoiceData['Invoice']['tax']) && $invoiceData['Invoice']['tax'] != 0)):
                    ?>
                    <tr>
                        <td style="text-align: center;"  colspan="3">
                            <strong>Deduction</strong>
                        </td>
                    </tr>
                    <?php
                    if (!empty($invoiceData['Invoice']['vat']) && $invoiceData['Invoice']['vat'] != 0):
                        ?>
                        <tr>
                            <td style="text-align: right;"  colspan="2">VAT (<?php echo $invoiceData['Invoice']['vat']; ?>&percnt; as per General Order No. 07/Musak/2012)</td>
                            <td style="text-align: center;"><?php echo $invoiceData['Invoice']['vat_amount']; ?></td>
                        </tr>
                        <?php
                    endif;
                    if (!empty($invoiceData['Invoice']['tax']) && $invoiceData['Invoice']['tax'] != 0):
                        ?>
                        <tr>
                            <td style="text-align: right;"  colspan="2">Advance Income TAX <?php echo $invoiceData['Invoice']['tax']; ?>&percnt; on Professional fees</td>
                            <td style="text-align: center;"><?php echo $invoiceData['Invoice']['tax_amount']; ?></td>
                        </tr>
                        <?php
                    endif;
                endif;
                ?>
                <tr>
                    <td style="text-align: right;"  colspan="2"><strong>Total Deduction</strong></td>
                    <td style="text-align: center;"><?php echo $invoiceData['Invoice']['total_deduction']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: right;"  colspan="2">
                        <strong>Net Bill Payable</strong><br />
                        <span>(Total bill - Total Deduction)</span>
                    </td>
                    <td style="text-align: center;"><?php echo $invoiceData['Invoice']['final_amount']; ?></td>
                </tr>
            </table>
            <span>(Taka <?php echo $finalAmountInWord; ?>) Only</span><br /><br /><br />

            <span>Please make cheque payable to "<b>Bhuiyan Islam &amp; Zaidi</b>"</span><br /><br /><br />

            <?php
            if (!empty($invoiceData['Invoice']['note'])) {
                echo '<p class="subjectText"><strong>N.B.: <b style="width:70%;">' . strip_tags($invoiceData['Invoice']['note']) . '</b></strong></p><br /><br /><br /><br />';
            }
            ?>

            <span>Thanking You,</span><br /><br /><br /><br /><br /><br />

            <strong>(Ariful Islam)</strong><br />
            <span>Barrister-at-Law</span><br />
            <strong>For: Bhuiyan Islam &amp; Zaidi</strong><br />

        </div>

    </body>
</html>