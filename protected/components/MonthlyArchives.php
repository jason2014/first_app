<?php 
Yii::import('zii.widgets.CPortlet');

class MonthLyArchives extends CPortlet
{
    public $title='档案';
    public $year = '年';
    public $month = '月';

    public function findAllPostDate()
    {
        return Post::model()->findArchives();
    }

    protected function renderContent()
    {
        $this->render('monthLyArchives');
    }
}
