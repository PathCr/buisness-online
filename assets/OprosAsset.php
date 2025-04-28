<?php

namespace app\assets;

class OprosAsset
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