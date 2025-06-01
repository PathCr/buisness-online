<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Cart;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\Product;
use yii\web\Controller;

class CartController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionAdd($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest)
        {
            return ['success' => false, 'message' => 'Необходимо авторизоваться'];
        }

        $product = Product::findOne($id);

        if (!$product)
        {
            return ['success' => false, 'message' => 'Товар не найден'];
        }

        $cartItem = Cart::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $id]);

        if ($cartItem)
        {
            $cartItem->quantity++;
            $cartItem->updated_at = time();
        } else {
            $cartItem = new Cart();
            $cartItem->product_id = $id;
            $cartItem->quantity = 1;
            $cartItem->price = $product->price;
            $cartItem->created_at = time();
            $cartItem->updated_at = time();
        }

        if ($cartItem->save())
        {
            return ['success' => true, 'message' => 'Товар добавлен в корзину'];
        } else {
            return ['success' => false, 'message' => 'Ошибка при добавлении товара', 'errors' => $cartItem->errors];
        }
    }

    public function actionRemove($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            return ['success' => false, 'message' => 'Необходимо авторизоваться'];
        }

        $cartItem = Cart::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $id]);

        if ($cartItem) {
            $cartItem->delete();
            return ['success' => true, 'message' => 'Товар удален из корзины', 'cart_count' => $this->getCartCount()];
        }

        return ['success' => false, 'message' => 'Товар не найден в корзине'];
    }

    public function actionUpdate($id, $quantity)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            return ['success' => false, 'message' => 'Необходимо авторизоваться'];
        }

        $cartItem = Cart::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $id]);

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            if ($cartItem->save()) {
                return ['success' => true, 'message' => 'Количество товара обновлено', 'cart_total' => $this->calculateTotal()];
            } else {
                return ['success' => false, 'message' => 'Ошибка обновления количества', 'errors' => $cartItem->errors];
            }
        }

        return ['success' => false, 'message' => 'Товар не найден в корзине'];
    }

    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->renderPartial('_cart', ['cart' => [], 'total' => 0]);
        }

        $cartItems = Cart::find()->where(['user_id' => Yii::$app->user->id])->all();
        $total = $this->calculateTotal();

        return $this->renderPartial('_cart', ['cart' => $cartItems, 'total' => $total]);
    }

    private function calculateTotal()
    {
        $total = 0;
        if (Yii::$app->user->isGuest) {
            return $total;
        }
        $cartItems = Cart::find()->where(['user_id' => Yii::$app->user->id])->all();
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    public function getCartCount()
    {
        if (Yii::$app->user->isGuest) {
            return 0;
        }
        return Cart::find()->where(['user_id' => Yii::$app->user->id])->count();
    }

    public function actionCount() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'success' => true,
            'count' => $this->getCartCount(),
        ];
    }
}