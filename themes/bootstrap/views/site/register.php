<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - register';
$this->breadcrumbs=array(
    '注册',
);
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'user-register-form',
    'htmlOptions'=>array('class'=>'well'),
    'type'=>'horizontal',  //bootstrap 
    'enableAjaxValidation'=>false,

    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model, 'username'); ?>

    <?php echo $form->textFieldRow($model, 'nickname'); ?>
    
    <?php echo $form->passwordFieldRow($model, 'password'); ?>

    <?php echo $form->textFieldRow($model, 'email'); ?>

    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="control-group">
        <?php echo $form->labelEx($model,'verifyCode'); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php $this->widget('CCaptcha', array(
                    'buttonLabel'=>'换一张',
                    'clickableImage'=>true,
                    'buttonOptions'=>array('display'=>'inline'),
                    'imageOptions'=>array('size'=>'120,20'),
        )); ?>

        <div class="controls">
            
            <?php echo $form->textField($model,'verifyCode'); ?>
            <?php echo $form->error($model,'verifyCode'); ?>

        </div>
    </div>
    <?php endif; ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'注册')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">→返回首页</a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(function(){
    $("label[for='User_verifyCode']").addClass("control-label");
});
</script>

