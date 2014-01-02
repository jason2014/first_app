<table class="detail-view table table-striped table-condensed">
    <tbody>
        <tr class="odd">
            <th>编号</th>
            <td><?php echo $model->id; ?></td>
        </tr>
        <tr class="even">
            <th>昵称</th>
            <td><?php echo $model->author; ?></td>
        </tr>
        <tr class="odd">
            <th>邮箱</th>
            <td><?php echo $model->email; ?></td>
        </tr>
        <tr class="even">
            <th>链接地址</th>
            <td><?php echo $model->url; ?></td>
        </tr>
        <tr class="odd">
            <th>内容</th>
            <td><?php echo $model->content; ?></td>
        </tr>
        <tr class="even">
            <th>状态</th>
            <td><?php echo Lookup::item('CommentStatus', $model->status); ?></td>
        </tr>
        <tr class="odd">
            <th>创建时间</th>
            <td><?php echo date('Y-m-d H:i:s', $model->created); ?></td>
        </tr>

    </tbody>
</table>

<div class="form-actions">
    <?php echo CHtml::link('编辑', array('admin/commentUpdate','id'=>$model->id), array('class'=>'btn btn-primary')); ?>
    <?php if($model->status==1): ?>
    &nbsp;&nbsp;&nbsp;&nbsp; 
    <a href="javascript:void(0);" id="status_go" class="btn btn-primary">审核通过</a>
    <?php endif; ?>
    &nbsp;&nbsp;&nbsp;&nbsp; 
    <a href="javascript:history.go(-1);" class="btn btn-primary">返回</a>    
</div>

<script>
$(function(){
    $('#status_go').click(function(){
        if(confirm('是否审核通过该评论')){
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('admin/commentStatusGo'); ?>",
                data: "id="+<?php echo $model->id; ?>,
                dataType: "html",
                success: function(data){
                    if(data==1){
                        window.location.reload();
                    }else{
                        alert('审核通过失败!');
                    }
                }
            });
        }
    });
})    
</script>

