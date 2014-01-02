<div class='post'>
    <div class="title">
        <i class="icon-bold"></i>
        <?php echo CHtml::link(CHtml::encode($data->title), $data->url); //$data->url 调用 Post.php中getUrl()方法  ?>
    </div>

    <div class="author">
        作者：<?php echo $data->author->username; ?>  发布时间：<?php echo date('Y-m-d H:i:s', $data->created); ?></div>
    
    <div class="content">
        <?php 
            $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
                echo $data->content;
                // echo Helper::truncate_utf8_string($data->content,140);  //显示省略号 
            $this->endWidget();
        ?>
    </div>

    <div class="nav">
        <b>标签：</b>
        <?php echo implode(', ', $data->tagLinks); //$data->tagLinks 调用 Post.php中getTagLinks()方法?>
        <br />
        <?php echo CHtml::link("评论 ({$data->commentCount})", $data->url.'#comments'); ?>
        |
        修改时间：<?php echo date('Y-m-d H:i:s', $data->updated); ?>
    </div>

</div>