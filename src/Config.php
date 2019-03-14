<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/3/12
 * Time: 下午5:06
 */

namespace Anlewo\ApiView;

use yii\base\Component;
use Yii;

class Config extends Component
{
    public static function getAllApiList()
    {
        $list = self::getActiveGroupCfg();
        foreach($list as $method=>$params){
            $groups[$method]=$list[$method]['groupName'];
        }
        return $groups;
    }

    public static function getAllVersions()
    {
        $AllVersions = \Yii::$app->controller->module->apiConfig;
        return array_keys($AllVersions);
    }

    public static function getActiveGroupList()
    {
        $g=Yii::$app->request->get('g');
        $list=self::getActiveGroupCfg();
        $group = $list[$g];
        $methodList = $group['methods'];
        foreach($methodList as $key => $val){

        }
        return $methodList;
    }

    public static function getActiveGroupCfg()
    {
        $v = \Yii::$app->request->get('v','v1');
        return \Yii::$app->controller->module->apiConfig[$v];
    }

    public static function getMethodInfo()
    {
        $v = Yii::$app->request->get('v','v1');
        $group = Yii::$app->request->get('g');
        $method = Yii::$app->request->get('method');

        $groupList = self::getActiveGroupCfg();
        $gname = $groupList[$group]['groupName'];
        $class = $groupList[$group]['methods'][$method];
        return [
            'gname'=>$gname,
            'class'=>$class
        ];
    }
}