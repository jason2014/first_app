<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span2">
        <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'tabs',
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'nav-stacked'),
            ));
        ?>
    </div>
    <div class="span12">
        <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'homeLink'=>CHtml::link('首页', Yii::app()->homeUrl),
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
        <?php endif?>

        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>