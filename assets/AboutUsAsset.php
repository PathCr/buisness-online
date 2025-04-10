<?php

namespace app\assets;

use yii\web\AssetBundle;
class AboutUsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/about.css',
    ];

    public $js = [
        'js/about.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}