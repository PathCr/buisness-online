<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class OprosOptions extends ActiveRecord
{
    public static function tableName()
    {
        return 'opros_options';
    }

    public static function getOptionsForQuestion($questionId) {
        $options = OprosOptions::find()
            ->where(['question_id' => $questionId])
            ->orderBy('id')
            ->asArray()
            ->all();

        return \yii\helpers\ArrayHelper::map($options, 'id', 'option_text');
    }
}