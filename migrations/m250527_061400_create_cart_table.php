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
            'user_id' => $this->integer()->notNull(), // ID пользователя
            'product_id' => $this->integer()->notNull(), // ID товара
            'quantity' => $this->integer()->notNull()->defaultValue(1), // Количество
            'price' => $this->decimal(10, 2)->notNull(), // Цена товара на момент добавления в корзину
            'created_at' => $this->integer()->notNull(), // Время добавления в корзину (timestamp)
            'updated_at' => $this->integer()->notNull(), // Время последнего обновления (timestamp)
        ]);

        $this->createIndex(
            'idx-cart-user_id',
            '{{%cart}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk-cart_items_user_id',
            '{{%cart}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cart_product_item_id',
            '{{%cart}}',
            'product_id',
            '{{%product}}',
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
            'fk-cart_items_user_id',
            '{{%cart}}'
        );

        $this->dropForeignKey(
            'fk-cart_product_item_id',
            '{{%cart}}'
        );

        $this->dropIndex(
            'idx-cart-user_id',
            '{{%cart}}'
        );

        $this->dropTable('{{%cart}}');
    }
}
