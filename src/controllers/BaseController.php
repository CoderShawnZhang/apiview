<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/3/12
 * Time: 下午5:51
 */

namespace Anlewo\ApiView\controllers;


use yii\web\Controller;

class BaseController extends Controller
{
    function init(){
        $this->layout="main";
    }
}