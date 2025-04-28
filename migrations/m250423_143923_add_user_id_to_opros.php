<?php

use yii\db\Migration;

class m250423_143923_add_user_id_to_opros extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%opros}}', 'user_id', $this->integer()->defaultValue(null));

        // Создаем индекс для поля user_id
        $this->createIndex(
            'idx-opros-user_id',
            '{{%opros}}',
            'user_id'
        );

        // Добавляем внешний ключ
        $this->addForeignKey(
            'fk-opros-user_id',
            '{{%opros}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-opros-user_id',
            '{{%opros}}'
        );

        // Удаляем индекс
        $this->dropIndex(
            'idx-opros-user_id',
            '{{%opros}}'
        );

        $this->dropColumn('{{%opros}}', 'user_id');
    }
}
