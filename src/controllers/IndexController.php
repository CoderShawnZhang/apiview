<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/3/12
 * Time: 下午4:32
 */
namespace Anlewo\ApiView\controllers;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}