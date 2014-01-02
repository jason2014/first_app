<?php
/* @var $this PostController */
/* @var $model Post */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/jjqSiteIndex.css');

$this->breadcrumbs=array(
	'文章'=>array('index'),
	$model->title,
);



?>

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>

<div id="comments">
	<?php if($model->commentCount>=1): ?>

		<div class="title-comment">
			<b class="left">文章评论</b>
			<div class="right">共有<?php echo $model->commentCount; ?>条评论(<a href="#comments">写评论</a>)</div><div class="clear"></div>
		</div>

		<?php $this->renderPartial('_comments', array(
			'post'=>$model,
			'comments'=>$model->comments,
		)); ?>

	<?php endif; ?>

	<div class="title-comment">
		<div class="left"><h3>写一个评论</h3></div>
		<div class="right"><a class="top" title="TOP" href="#top"></a></div>
		<div class="clear"></div>
	</div>
	

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?>
		<?php $this->renderPartial('/comment/_form', array(
			'model' => $comment,
		)); ?>
	<?php endif; ?>

		
	
</div>
