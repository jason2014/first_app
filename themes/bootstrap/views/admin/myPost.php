<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
    '文章'=>array('index'),
    '我的文章',
);

?>

<table class="items table table-bordered">
    <thead>
        <tr style="background:#ccc;">
            <th nowrap="nowrap"><?php echo $sort->link('id', '编号'); ?></th>
            <th nowrap="nowrap">标题</th>
            <th nowrap="nowrap">作者</th>
            <th nowrap="nowrap"><?php echo $sort->link('comment_count', '评论个数'); ?></th>
            <th nowrap="nowrap"><?php echo $sort->link('created', '创建时间'); ?></th>
            <th nowrap="nowrap"><?php echo $sort->link('updated', '修改时间'); ?></th>
            <th class="button-column">操&nbsp;&nbsp;作</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($model as $list): ?>
        <tr>
            <td style="width: 30px; text-align: center;">
                <a class="view" title="查看" rel="tooltip" href="<?php echo Yii::app()->createUrl('admin/view', array('id'=>$list['id'])) ?>"><?php echo $list['id']; ?></a>
            </td>
            <td><?php echo $list['title']; ?></td>
            <td><?php echo $list['username']; ?></td>
            <td><?php echo $list['comment_count']; ?></td>
            <td><?php echo $list['created']; ?></td>
            <td><?php echo $list['updated']; ?></td>
            <td class="button-column">
                <a class="update" title="编辑" rel="tooltip" href="<?php echo Yii::app()->createUrl('admin/update', array('id'=>$list['id'])); ?>"><i class="icon-pencil"></i></a> 
                &nbsp;&nbsp;
                <a class="delete" title="删除" rel="tooltip" href="javascript:void(0);" post_id="<?php echo $list['id']; ?>" post_title="<?php echo $list['title']; ?>"><i class="icon-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="7">
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
$(function(){
    $('tbody tr:odd').addClass('odd');
    $('tbody tr:even').addClass('even');
    $('.odd').css("background-color","#F2F2F2");
    $('.even').hover(function(){       
            $(this).css("background-color","#FFFF00");   
        },function(){        
            $(this).css("background-color","#FFFFFF");    
        })

    //删除文章
    $('.delete').click(function(){
        var post_id = $(this).attr('post_id')
        var post_title = $(this).attr('post_title');
        if(confirm('是否要删除编号为：'+post_id+'\n标题为：'+post_title+'\n的文章!')){
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('admin/postDelete'); ?>",
                data: "id="+post_id,
                dataType: "html",
                success: function(data){
                    if(data==1){
                        window.location.reload();
                    }else{
                        alert('删除文章失败！');
                    }
                }
            });
        }
    });

});
</script>


