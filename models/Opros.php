<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Opros extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%opros}}';
    }

    public function rules()
    {
        return [
            [['question1', 'question2', 'question3', 'question4', 'question6', 'question8', 'question9', 'question10', 'question5', 'question11'], 'string'],
            [['question1', 'question2', 'question3', 'question4', 'question6', 'question8', 'question9', 'question10', 'question12'], 'required',
                'message' => 'Обязательное поле'],
            [['question12', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'question1' => 'Как часто вы посещаете аптеки?',
            'question2' => 'Как часто вы употребляете пиво?',
            'question3' => 'Считаете ли вы употребление пива вредным для здоровья?',
            'question4' => 'Какие меры вы обычно принимаете для облегчения похмельного синдрома?',
            'question5' => 'Какие средства от похмелья вы обычно покупаете?',
            'question6' => 'Где вы обычно покупаете средства от похмелья?',
            'question8' => 'Готовы ли вы получать консультации в аптеке?',
            'question9' => 'Насколько вы доверяете информации о здоровье, которую предоставляет фармацевт?',
            'question10' => 'Как вы считаете, уместно ли продавать в аптеке товары, связанные с алкоголем?',
            'question11' => 'Ваш пол',
            'question12' => 'Ваш возраст',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


}