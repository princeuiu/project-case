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

$cakeDescription = __d('cake_dev', 'Rate Us:<br />Simple rating application');
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
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
                    'bootstrap/css/bootstrap.min',
                    'bootstrap/css/bootstrap-theme.min',
                    'rating-star/css/star-rating.min',
                    'custom-style'
                    ));
	?>
<!--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>-->
    <?php
        echo $this->Html->script(array(
            'bootstrap/js/bootstrap.min',
            'rating-star/star-rating.min',
            'jquery.canvasjs.min',
            'custom'
            ));
    ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var BASE = "<?php echo $this->Html->url('/'); ?>";
        var ratingMsg = '';
        var ratingTitle = '';
    </script>
</head>
<body>
    <div class="container-fluid background">
        <div class="container main-background">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-7">
                                <h2 class=""><?php echo $cakeDescription; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php //pr($this->params); ?>
			<?php echo $this->Session->flash(); ?>
                        <?php echo $this->element('admin/nav', array('cont'=>$this->params['controller'], 'act'=>$this->params['action'])); ?>
			<?php echo $this->fetch('content'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
			
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:history.go(-1)" class="btnBackPrevPage">Back</a>
</body>
</html>
