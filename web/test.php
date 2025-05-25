<?php


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


$config = require __DIR__ . '/../config/web.php';  // Или config/console.php, если тестируете консольное приложение

(new yii\web\Application($config)); // Создаем экземпляр приложения, но не запускаем его

var_dump(Yii::$app->authManager);