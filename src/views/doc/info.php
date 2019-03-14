
<ol class="breadcrumb">
    <li><i class='glyphicon glyphicon-home'></i> <a href="<?=\yii\helpers\Url::to(['doc/index'])?>">Overview</a></li>
    <li><a href="#"><?=$v?></a></li>
    <li><a href="<?=\yii\helpers\Url::to(['doc/group','g'=>$g,'v'=>$v])?>"><?=$gname?></a></li>
    <li class="active"><?=$methodInfo['apiDescription']?> <?=$method?></li>
</ol>



<h3>请求地址</h3>
<p class=apiurl ><label class="label label-warning"><?=$methodInfo['verbs']?></label> <?=$methodInfo['url']?>

    <a href="<?=\yii\helpers\Url::to(['doc/test','method'=>$method,'g'=>$g,'v'=>$v])?>" class='btn btn-success btn-xs'>测试工具>></a>


</p>
<h3>输入参数</h3>
<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th>字段</th>
        <th>数据类型</th>
        <th>描述</th>
        <th>示例值</th>
    </tr>

    <?php foreach($methodInfo['params'] as $field=>$val):?>
        <tr>
            <td><code><?=$field?></code></td>
            <td><?=$val['type']?:'string'?></td>
            <td><?=$val['description']?></td>
            <td><?=$val['value']?></td>
        </tr>
    <?php endforeach?>
</table>
<h3>返回字段</h3>
<table class="table table-striped table-bordered table-condensed" style='width:50%'>
    <tr>
        <th>字段</th>
        <th>返回类型</th>
        <th>说明</th>
    </tr>
</table>
<h3>返回结果示例JSON</h3>


<script>
    $(function(){

    })
</script>