<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m250330_112345_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'price' => $this->string()->notNull(),
            'quantity' => $this->integer()->defaultValue(0),
            'created_at' => $this->string()->notNull(),
            'updated_at' => $this->string()->notNull(),
        ]);

        $this->createIndex(
            'idx-product-category_id',
            '{{%product}}',
            'category_id'
        );

        $this->createIndex(
            'idx-product-name',
            '{{%product}}',
            'name'
        );

        $this->addForeignKey(
            'fk-product-category_id',
            '{{%product}}',
            'category_id',
            '{{%categories}}',
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
            'fk-product-category_id',
            '{{%product}}'
        );

        $this->dropIndex(
            'idx-product-category_id',
            '{{%product}}'
        );

        $this->dropIndex(
            'idx-product-name',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
