<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">
    
    <?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
        'class'=>'cid',
        'title'=>'Permalink to this comment',
    )); ?>
    
    <div class="author">
        用户：<?php echo $comment->authorLink; ?>
        &nbsp;
        发布时间：<?php echo date('Y-m-d H:i:s', $comment->created); ?>
        &nbsp;
        IP地址：[ <?php echo $comment->ip; ?> ]says:
    </div>
    
    <div class="content">
        <?php echo nl2br(CHtml::encode($comment->content)); ?>
    </div>
</div>
    
<?php endforeach; ?>

