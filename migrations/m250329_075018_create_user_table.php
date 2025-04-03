<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250329_075018_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(191)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->notNull(),
            'email' => $this->string(191)->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'role' => $this->string()->defaultValue('user'),
        ]);

        $this->createIndex(
            'idx-user-username',
            '{{%user}}',
            'username'
        );

        $this->createIndex(
            'idx-user-status',
            '{{%user}}',
            'status'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-user-username',
            '{{%user}}'
        );

        $this->dropIndex(
            'idx-user-status',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
