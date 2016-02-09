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
if(isset($title) && $title != null){
    $cakeDescription = __d('cake_dev', $title);
}
else{
    $cakeDescription = __d('cake_dev', 'Your Opinion Matter for Us!');
}
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <?php
        echo $this->Html->script(array(
            'bootstrap/js/bootstrap.min',
            'rating-star/star-rating.min',
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
                    <?php echo $this->Session->flash(); ?>
                    <div class="login-header">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
