<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%opros_options}}`.
 */
class m250423_143452_create_opros_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%opros_options}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull()->comment('ID вопроса, к которому относится вариант ответа'),
            'option_text' => $this->string()->notNull()->comment('Текст варианта ответа'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%opros_options}}');
    }
}
