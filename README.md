
<p align="center">
    <a href="https://laravel-excel.maatwebsite.nl">
        <img alt="Laravel Excel" src="https://user-images.githubusercontent.com/7728097/43685313-ff1e2110-98b0-11e8-8b50-900a2b262f0f.png" />
    </a>
</p>

<h1 align="center">
    Api View 1.0.0
</h1>



api接口文档扩展插件图片鉴赏
![](https://github.com/CoderShawnZhang/apiview/blob/master/img/1.png)
![](https://github.com/CoderShawnZhang/apiview/blob/master/img/2.png)
![](https://github.com/CoderShawnZhang/apiview/blob/master/img/3.png)

# 使用方式：
```php
composer require anlewo/apiview dev-master
```

# 配置方式
### 1
```php
"modules" => [
    'ApiView' => [
        'class' => 'Anlewo\ApiView\Module',
        'apiConfig' =>  require __DIR__.'/../../api/config/apiConfig.php',
        'apiHost' => 'http://yii2api.local.alwooo.com',
    ]
]
```

### 2
在api目录下的config文件夹添加apiConfig.php文件
内容如下：
```php   
    <?php
    /**
     * v1.0版本痛哦过配置文件生成文档
     * 预计v2.0版本根据反射生成文档
     */
        return [
            'v1'=>[
                'main' => [
                    'groupName' => '测试1',
                    'methods' => [
                        'index'=>['url'=>'/index/index','params'=>[
                                'access-token'=>['type'=>'int','value'=>'02818451399b5cde5f3c05bd00e72aab','description'=>'用户认证令牌access-token'],
                            ],
                            'apiDescription'=>'获取用户基本信息','verbs'=>'GET'
                        ],
                        'getUserName1'=>['url'=>'www.baidu.com','params'=>[],'apiDescription'=>'测试','verbs'=>'post'],
                        'getUserName2'=>['url'=>'www.baidu.com','params'=>[],'apiDescription'=>'测试','verbs'=>'post'],
                        'getUserName3'=>['url'=>'www.baidu.com','params'=>[],'apiDescription'=>'测试','verbs'=>'post'],
                    ]
                ],
                'fruitrue' => [
                    'groupName' => '测试2',
                    'methods' => [
                        'aaa' => ['url'=>'www.baidu.com','params'=>'','apiDescription'=>'测试','verbs'=>'post'],
                        'bbb' => ['url'=>'www.baidu.com','params'=>'','apiDescription'=>'测试','verbs'=>'post'],
                        'ccc' => ['url'=>'www.baidu.com','params'=>'','apiDescription'=>'测试','verbs'=>'post'],
                        'ddd' => ['url'=>'www.baidu.com','params'=>'','apiDescription'=>'测试','verbs'=>'post'],
                    ]
                ]
            ],
            'v2' => [
    
            ]
        ];
``` 
#访问地址///
```php
HOST + /ApiView/doc/index?v=v1  例如   http://yii2admin.local.alwooo.com/ApiView/doc/index?v=v1
``` 