<?php 
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.config.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.all.min.js');
?>
<div class="newComment">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'comment-form',
    'htmlOptions'=>array('class'=>'well'),
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'author'); ?>

    <?php echo $form->textFieldRow($model, 'email'); ?>

    <?php echo $form->textFieldRow($model, 'url'); ?>
    
    <div class="control-group ">
        <?php echo $form->labelEx($model, 'content', array('class'=>'control-label')); ?>
        <div class="controls" style="margin-left: 100px;">
            <?php echo $form->textArea($model,'content'); ?>
        </div>

        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:history.go(-1);" class="btn btn-primary">返回</a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(function(){
    $("#comment-form .control-label").css('width','70px');
    $("#comment-form .controls").css('margin-left','90px');
    $("#comment_summary").css('width','400px');

    UE.getEditor('Comment_content', {
        theme:"default", //皮肤
        lang:'zh-cn', //语言
        wordCount:false, //关闭字数统计
        elementPathEnabled:false, //左下角显示元素路径 
        initialFrameWidth:550, //宽度
        initialFrameHeight:200, //高度
        toolbars: [["fontfamily","fontsize","forecolor","bold","italic","strikethrough","|",
"insertunorderedlist","insertorderedlist","blockquote","|",
"link","unlink","highlightcode","|","undo","redo"]],
    });
});
</script>