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
                width: 100%;
                margin-bottom:30px;
            }
            #pdf .log .last,#pdf .dataTable .last{
                display: none;
            }
            #pdf .summary{
                font:bold 18px/22px arial;
                margin:10px 0;

            }

            #pdf strong{
                color:#000;
            }
            #pdf span{
                font:bold 18px/22px arial;
                color:#000;
            }
        </style>
    </head>
    <body id="pdf">
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
            <span><?php echo $invoiceData['Client']['address']; ?></span><br />
            
            <table class="dataTable">
                <tr>
                    <th style="text-align: center">Sl. No</th>
                    <th style="text-align: center">Particulars</th>
                    <th style="text-align: center">Amount in<br />BDT</th>
                    <th style="text-align: center">Deduction</th>
                    <th style="text-align: center">Net Bill</th>
                </tr>
                <?php
                ?>
            </table>
            
        </div>

        <?php //echo $content_for_layout ?>
        <?php //echo 'this is a pdf file'; ?>

    </body>
</html>