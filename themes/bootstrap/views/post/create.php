<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'文章'=>array('index'),
	'添加',
);

// $this->menu=array(
// 	array('label'=>'List Post', 'url'=>array('index')),
// 	array('label'=>'管理文章', 'url'=>array('admin')),
// );
?>

<h1>添加文章</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>