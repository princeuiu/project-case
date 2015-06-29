<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', '||Law Firm V1.0||Simple as possible');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $this->fetch('title'); ?>
        </title>
        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'bootstrap.min',
            'bootstrap-responsive.min',
            'style',
            'style-responsive',
        ));
        ?>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <?php
        echo $this->Html->css(array(
            'ie'
        ));
        ?>
        <![endif]-->

        <!--[if IE 9]>
        <?php
        echo $this->Html->css(array(
            'ie9'
        ));
        ?>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <?php
        echo $this->Html->script(array(
            'jquery-migrate-1.0.0.min',
            'jquery-ui-1.10.0.custom.min',
            'jquery.ui.touch-punch',
            'modernizr',
            'bootstrap.min',
            'jquery.cookie',
            'fullcalendar.min',
            'jquery.dataTables.min',
            'excanvas',
            'jquery.flot',
            'jquery.flot.pie',
            'jquery.flot.stack',
            'jquery.flot.resize.min',
            'jquery.chosen.min',
            'jquery.uniform.min',
            'jquery.cleditor.min',
            'jquery.noty',
            'jquery.elfinder.min',
            'jquery.raty.min',
            'jquery.iphone.toggle',
            'jquery.uploadify-3.1.min',
            'jquery.gritter.min',
            'jquery.imagesloaded',
            'jquery.masonry.min',
            'jquery.knob.modified',
            'jquery.sparkline.min',
            'counter',
            'retina',
            'custom'
        ));
        ?>

        <script type="text/javascript">
            var BASE = "<?php echo $this->Html->url('/'); ?>";
            var ratingMsg = '';
            var ratingTitle = '';
        </script>
    </head>

    <body>

        <?php
        echo $this->element('admin/header');
        ?>

        <div class="container-fluid-full">
            <div class="row-fluid">

                <!-- start: Main Menu -->
                <?php echo $this->element('admin/nav', array('cont'=>$this->params['controller'], 'act'=>$this->params['action'])); ?>
                <!-- end: Main Menu -->

                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <!-- start: Content -->
                <div id="content" class="span10">


                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a> 
                            <i class="icon-angle-right"></i>
                        </li>
                        <li><a href="#">Dashboard</a></li>
                    </ul>

                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>


                    
                </div><!--/.fluid-container-->

                <!-- end: Content -->
            </div><!--/#content.span10-->
        </div><!--/fluid-row-->

        <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>

        <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <ul class="list-inline item-details">
                    <li><a href="http://themifycloud.com">Admin templates</a></li>
                    <li><a href="http://themescloud.org">Bootstrap themes</a></li>
                </ul>
            </div>
        </div>

        <div class="clearfix"></div>

        <footer>

            <p>
                <span style="text-align:left;float:left">&copy; 2013 <a href="http://themifycloud.com/downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>

            </p>

        </footer>

    </body>
</html>
