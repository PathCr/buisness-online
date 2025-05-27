<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m250527_061400_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
