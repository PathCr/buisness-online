<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Product $product
 * @property User $user
 */

class Cart extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%cart}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity', 'price', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'product_id', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord)
        {
            $this->user_id = \Yii::$app->user->id;
        }

        return parent::beforeValidate();
    }
}