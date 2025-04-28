<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%opros}}`.
 */
class m250423_143141_create_opros_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%opros}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'question1' => $this->integer()->defaultValue(null)->comment('Как часто вы посещаете аптеки?'),
            'question2' => $this->integer()->defaultValue(null)->comment('Как часто вы употребляете пиво?'),
            'question3' => $this->integer()->defaultValue(null)->comment('Считаете ли вы употребление пива вредным для здоровья?'),
            'question4' => $this->integer()->defaultValue(null)->comment('Какие меры вы обычно принимаете для облегчения похмельного синдрома?'),
            'question5' => $this->text()->defaultValue(null)->comment('Какие средства от похмелья вы обычно покупаете?'),
            'question6' => $this->integer()->defaultValue(null)->comment('Где вы обычно покупаете средства от похмелья?'),
            'question8' => $this->integer()->defaultValue(null)->comment('Готовы ли вы получать консультации в аптеке?'),
            'question9' => $this->integer()->defaultValue(null)->comment('Насколько вы доверяете информации о здоровье, которую предоставляет фармацевт?'),
            'question10' => $this->integer()->defaultValue(null)->comment('Как вы считаете, уместно ли продавать в аптеке товары, связанные с алкоголем?'),
            'gender' => $this->string()->defaultValue(null)->comment('Ваш пол'),
            'age' => $this->integer()->defaultValue(null)->comment('Ваш возраст'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%opros}}');
    }
}
