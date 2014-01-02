<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'文章'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'编辑',
);

?>

<h1>编号为 <?php echo $model->id; ?> 的文章</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>