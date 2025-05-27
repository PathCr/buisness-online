<?php

use yii\db\Migration;

class m250525_083317_fill_opros_options_gender extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(\app\models\OprosOptions::tableName(),
            ['question_id', 'option_text'],
            [
                [11, 'Мужской'],
                [11, 'Женский']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(\app\models\OprosOptions::tableName(), [
            'question_id' => 11,
            'option_text' => ['Мужской', 'Женский'],
        ]);
    }
}
