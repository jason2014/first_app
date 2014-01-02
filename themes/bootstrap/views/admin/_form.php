<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
    'type'=>'horizontal',  //bootstrap 
)); ?>

	<p class="note">添加<span class="required">*</span> 的字段不能为空.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->textFieldRow($model, 'title'); ?>
	
	<?php echo $form->textAreaRow($model, 'summary'); ?>
    
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'content', array('class'=>'control-label')); ?>
        <div class="controls" style="margin-left: 100px;">
            <?php echo $form->textArea($model,'content'); ?>
        </div>

        <?php echo $form->error($model, 'content'); ?>
    </div>

	<?php echo $form->textAreaRow($model, 'tags'); ?>

	<?php echo $form->dropDownListRow($model, 'status', Lookup::items('PostStatus')); ?>
	
	<div class="form-actions">

        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? '创建' : '保存')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
            
        <a href="javascript:history.go(-1);" class="btn btn-primary">返回</a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl;?>/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl;?>/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript">
KindEditor.ready(function(K) {
        window.editor = K.create('#Post_content');
});
$(function(){
    $("#post-form .control-label").css('width','50px');
    $("#post-form .controls").css('margin-left','70px');
    $("#Post_summary").css('width','400px');
    

    // UE.getEditor('Post_content', {
    //     theme:"default", //皮肤
    //     lang:'zh-cn', //语言
    //     wordCount:true, //关闭字数统计
    //     elementPathEnabled:false, //左下角显示元素路径 
    //     //initialFrameWidth:800, //宽度
    //     initialFrameHeight:500, //高度
    // });


});
</script>