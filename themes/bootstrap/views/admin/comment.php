<?php 
$this->breadcrumbs=array(
    '评论'=>array('index'),
);
?>
<table class="items table table-bordered">
    <thead>
        <tr style="background:#ccc;">
            <th nowrap="nowrap"><?php echo $sort->link('id', '编号'); ?></th>
            <th nowrap="nowrap">文章标题</th>
            <th nowrap="nowrap">评论者</th>
            <th nowrap="nowrap" width="300">评论内容</th>
            <th nowrap="nowrap"><?php echo $sort->link('status', '状态'); ?></th>
            <th nowrap="nowrap"><?php //echo $sort->link('created', '创建时间'); ?>创建时间</th>
            <th nowrap="nowrap" class="button-column">操&nbsp;&nbsp;&nbsp;&nbsp;作</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($models as $model): ?>
        <tr>
            <td style="width: 30px; text-align: center;"><?php echo CHtml::link($model['id'], array('commentView', 'id'=>$model['id'])); ?></td>
            <td><?php echo $model['title']; ?></td>
            <td><?php echo $model['author']; ?></td>
            <td><?php echo $model['content']; ?></td>
            <td><?php echo Lookup::item('CommentStatus', $model['status']); ?></td>
            <td><?php echo date('Y-m-d H:i:s', $model['created']); ?></td>
            <td class="button-column">
                <a class="update" title="编辑" rel="tooltip" href="<?php echo Yii::app()->createUrl('admin/commentUpdate', array('id'=>$model['id'])); ?>"><i class="icon-pencil"></i></a> 
                &nbsp;&nbsp;
                <a class="delete" title="删除" rel="tooltip" href="javascript:void(0)" comment_id="<?php echo $model['id']; ?>"><i class="icon-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="6">
            <?php $this->widget('CLinkPager',array(    
                'header'=>'',    
                'firstPageLabel' => '首页',    
                'lastPageLabel' => '末页',    
                'prevPageLabel' => '上一页',    
                'nextPageLabel' => '下一页',    
                'pages' => $pages,    
                'maxButtonCount'=>13,
                'cssFile'=>Yii::app()->request->baseUrl.'/css/page.css',    
            )); ?>   
         </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    //删除文章
    $('.delete').click(function(){
        var comment_id = $(this).attr('comment_id')
        if(confirm('是否要删除编号为：'+comment_id+'的评论')){
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('admin/commentDelete'); ?>",
                data: "id="+comment_id,
                dataType: "html",
                success: function(data){
                    if(data==1){
                        window.location.reload();
                    }else{
                        alert('删除评论失败！');
                    }
                }
            });
        }
    });
</script>