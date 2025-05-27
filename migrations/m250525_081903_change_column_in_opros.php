<?php

use yii\db\Migration;

class m250525_081903_change_column_in_opros extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn(\app\models\Opros::tableName(), 'gender', 'question11');
        $this->renameColumn(\app\models\Opros::tableName(), 'age', 'question12');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn(\app\models\Opros::tableName(), 'question11', 'gender');
        $this->renameColumn(\app\models\Opros::tableName(), 'question12', 'age');
    }

}
