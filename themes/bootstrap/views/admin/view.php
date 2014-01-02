<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'文章'=>array('index'),
	$model->title,
);

?>

<h1>View Post #<?php echo $model->id; ?></h1>

<table class="detail-view table table-striped table-condensed">
	<tbody>
		<tr class="odd">
			<th>编号</th>
			<td><?php echo $model->id; ?></td>
		</tr>
		<tr class="even">
			<th>标题</th>
			<td><?php echo $model->title; ?></td>
		</tr>
		<tr class="even">
			<th>摘要</th>
			<td><?php echo $model->summary; ?></td>
		</tr>
		<tr class="odd">
			<th>内容</th>
			<td><?php echo $model->content; ?></td>
		</tr>
		<tr class="odd">
			<th>标签</th>
			<td><?php echo $model->tags; ?></td>
		</tr>
		<tr class="even">
			<th>状态</th>
			<td><?php echo Lookup::item('PostStatus', $model->status); ?></td>
		</tr>
		<tr class="odd">
			<th>创建时间</th>
			<td><?php echo date('Y-m-d H:i:s', $model->created); ?></td>
		</tr>
		<tr class="even">
			<th>更新时间</th>
			<td><?php echo date('Y-m-d H:i:s', $model->updated); ?></td>
		</tr>
		<tr class="odd">
			<th>作者</th>
			<td><?php echo $model->author->username; ?></td>
		</tr>

	</tbody>
</table>

<div class="form-actions">
	<?php echo CHtml::link('编辑', array('post/update','id'=>$model->id), array('class'=>'btn btn-primary')); ?>

    &nbsp;&nbsp;&nbsp;&nbsp; 
    <a href="javascript:history.go(-1);" class="btn btn-primary">返回</a>    
</div>

