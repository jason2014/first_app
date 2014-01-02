<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'type' => 'inverse',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'首页', 'url'=>array('/site/index')),
                array('label'=>'功能', 'url'=>'#', 'items'=>array(
                    array('label'=>'创建文章', 'url'=>array('/admin/create')),
                    array('label'=>'文章管理', 'url'=>array('/admin/myPost')),
                    array('label'=>'评论管理', 'url'=>array('/admin/comment')),
                ), 'visible'=>!Yii::app()->user->isGuest),
               // array('label'=>'关于我们', 'url'=>array('/site/page', 'view'=>'about')),
               // array('label'=>'联系我们', 'url'=>array('/site/contact')),
                array('label'=>'注册', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'退出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
