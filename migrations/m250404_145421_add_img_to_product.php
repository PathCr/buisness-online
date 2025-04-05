<?php

use yii\db\Migration;

class m250404_145421_add_img_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'image', $this->string(255)->after('quantity'));
    }

    public function safeDown()
    {
        $this->dropColumn('product', 'image');
    }
}
