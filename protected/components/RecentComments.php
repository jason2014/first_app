<?php 
Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
    public $maxComments = 10;

    public function getRecentComments()
    {
        return Comment::model()->findRecentComments($this->maxComments);
    }

    protected function renderContent()
    {
        // $this->render('recentComments');
        echo '<ul>';
        foreach($this->getRecentComments() as $comment)
        {
            echo '<li>';
            echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl());
            echo '</li>';
        }
        echo '</ul>';
    }
}