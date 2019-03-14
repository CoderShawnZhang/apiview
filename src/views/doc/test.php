

<ol class="breadcrumb">
    <li><i class='glyphicon glyphicon-home'></i> <a href="<?=\yii\helpers\Url::to(['doc/index'])?>">Overview</a></li>
    <li><a href="#"><?=$v?></a></li>
    <li><a href="<?=\yii\helpers\Url::to(['doc/group','g'=>$g,'v'=>$v])?>"><?=$gname?></a></li>
    <li><a href="<?=\yii\helpers\Url::to(['doc/info','g'=>$g,'v'=>$v,'method'=>$method])?>"><?=$methodInfo['apiDescription']?></a></li>
    <li class="active">测试 <?=$method?></li>
</ol>

<h3>请求地址</h3>
<p>
    <label class='label label-warning'><?=$methodInfo['verbs']?></label>
    <span class="apiurl"><?= $url ?></span>
</p>
<h3>输入参数</h3>
<table class="table table-striped table-bordered "  >
    <tr>
        <th>字段</th>
        <th>输入值</th>
        <th>数据类型</th>
        <th>描述</th>
        <th>示例值</th>
    </tr>
    <?php foreach($methodInfo['params'] as $field=>$val):?>
        <tr class=tr-field >
            <td class='field'><code><?=$field?></code></td>
            <td><input type="text" style='width:100%' class="input" value="<?=$val['value']?>"></td>
            <td><?=$val['type']?:'string'?></td>
            <td><?=$val['description']?></td>
            <td><?=$val['value']?></td>
        </tr>
    <?php endforeach?>
</table>

<button class='btn btn-success btnstart'>执行请求</button>

<h3 class=returnx >执行结果 </h3>
<pre><code id="return">{}</code></pre>

<div class=returnurl >
    <h3>访问的Url </h3>
    <div class="well well-returnurl">...</div>
</div>


<script>
    $(function(){
        $('.btnstart').click(function(){
            var data={};
            $('.tr-field').each(function(k,v){
                var field=$(v).find('.field').text();
                data[field]=$(v).find('.input').val();
            });
            var apiurl=$('.apiurl').text();
            var method='<?=$method?>';
            var verbs='<?=$methodInfo['verbs']?>';
            $('.returnx label').remove();

            $.ajax({
                url:'http://yii2admin.local.alwooo.com/ApiView/doc/dotest',
                type:'get',
                data:{
                    data,apiurl,verbs
                },
                success:function(ret){
                    $('.returnx label').remove();
                    $('.returnx').append('<label class="label label-warning" title="耗时">'+ret.time+'s </label>');
                    $('#return').html('请求链接:<a href='+ret.reqUrl+' target=_blank > '+ret.reqUrl+'</a><br><br>'+ret.return);


                    var str = JSON.stringify(ret.returnJson, undefined, 2);
                    $('#return').html(str);

                    $('.well-returnurl').html("<a href='"+ret.reqUrl+"' target=_blank >"+ret.reqUrl+"</a>");
                },
                error:function(ret){
                    console.log(ret)
                    $('.returnx label').remove();
                    $('#return').html(ret.responseText);
                }
            });
        })
    });
</script>

<style>
    .label{font-size:12px}
</style>