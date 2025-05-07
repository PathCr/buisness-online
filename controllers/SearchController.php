<?php

namespace app\controllers;

use app\models\Product;
use yii\web\Controller;

class SearchController extends Controller
{


    public function actionSearch()
    {
        $products = Product::find()->all();

        return $this->render('search', [
            'products' => $products,
        ]);
    }


}