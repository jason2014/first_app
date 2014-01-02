<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span9">
        <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'homeLink'=>CHtml::link('首页', Yii::app()->homeUrl),
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
        <?php endif?>

        <?php echo $content; ?>
    </div>

    <div class="span3">
        <?php $this->widget('TagCloud', array(
            'title'=>'标签',
            'maxTags'=>20,
            'htmlOptions'=>array('class'=>'category'),
        )); ?>
        
        <?php $this->widget('RecentComments', array(
            'title'=>'最新评论的文章',
            'maxComments'=>10,
            'htmlOptions'=>array('class'=>'category'),
        )); ?>
        
        <?php $this->widget('MonthlyArchives', array(
            'year'=>'年',
            'month'=>'月',
            'htmlOptions'=>array('class'=>'category'),
        )); ?>

        <?php 
        // $this->widget('bootstrap.widgets.TbMenu', array(
        //     'type'=>'list',
        //     'items'=>array(
        //         array('label'=>'标签'),
        //         array('label'=>'Home', 'icon'=>'home', 'url'=>'#',),
        //         array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        //         array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        //         array('label'=>'ANOTHER LIST HEADER'),
        //         '',
        //         array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        //         array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        //         array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
        //     ),
        // )); ?>
    </div>

</div>
<?php $this->endContent(); ?>