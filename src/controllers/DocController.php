<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/3/12
 * Time: 下午5:47
 */

namespace Anlewo\ApiView\controllers;

use Anlewo\ApiView\Config;
use Yii;
use yii\helpers\Url;

class DocController extends BaseController
{
    public $title;

    public function actionIndex()
    {
        return $this->title('')->render('index');
    }
    public function actionGroup()
    {
        $list = Config::getActiveGroupList();
        $g = \Yii::$app->request->get('g');
        return $this->title()->render('group',[
            'list' => $list,
            'g' => $g,
            'count' => count($list),
            'v' => $this->getNowVersion(),
        ]);
    }

    public function actionInfo($view = 'info'){
        $info=Config::getMethodInfo();
        $verbs = $info['class']['verbs'];
        $method=Yii::$app->request->get('method');
        $s = [$method];
        if($verbs == 'GET'){
            $params = $info['class']['params'];
            foreach($params as $key => $val){
                $s[$key] = $val['value'];
            }
        }
        $g=Yii::$app->request->get('g');
        $curVersion = $this->getNowVersion();
        return $this->title($method.'接口的详情')->render($view,[
            'methodInfo'=>$info['class'],
            'method'=>$method,
            'url' => \Yii::$app->controller->module->apiHost . '/' . $curVersion . $info['class']['url'],
            'v'=>$curVersion,
            'g'=>$g,
            'gname'=>$info['gname'],
        ]);
    }

    public function actionTest()
    {
        return $this->title('测试：')->actionInfo('test');
    }

    public function title($title = '')
    {
        $this->title = $title;
        return $this;
    }

    private function getNowVersion()
    {
        return \Yii::$app->request->get('v',$this->module->defaultVersion);
    }

    public function actionDotest()
    {
        $data=$_REQUEST;
        $start = \microtime(true);
        $curl = curl_init(true);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if(preg_match("/get/",strtolower($data['verbs']))){
            $url=http_build_query($data['data']);
            $reqUrl=$data['apiurl'].'?'.$url;
            curl_setopt($curl, CURLOPT_URL,$reqUrl);
        }else{
            $reqUrl=$data['apiurl'];
            curl_setopt($curl, CURLOPT_URL,$data['apiurl']);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data['data']);
            curl_setopt($curl,CURLOPT_ENCODING , "");
            curl_setopt($curl,CURLOPT_MAXREDIRS , 10);
            curl_setopt($curl,CURLOPT_TIMEOUT , 30);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, "");
            $header = [
                "Authorization: Bearer 02818451399b5cde5f3c05bd00e72aab",
                "Postman-Token: 7e50eaf7-b0f0-4217-ac6e-426f3f056035",
                "cache-control: no-cache"
            ];
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data['data']));
        }
        $data = curl_exec($curl);
        $end = \microtime(true);
        // 检查是否有错误发生
        if(curl_errno($curl)){
            $return=[
                'code'=>'500',
                'msg'=>'curl error:'.curl_error($curl),
            ];
        }else{
            $return=$data;
        }
        curl_close($curl);
        return $this->asJson([
            'return'=>$return,
            'returnJson'=>is_array($return)?$return:json_decode($return),
            'time'=>round($end-$start,4),
            'reqUrl'=>$reqUrl
        ]);
    }
}