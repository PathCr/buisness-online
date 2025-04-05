<?php

use yii\db\Migration;

class m250404_143510_fill_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('categories',
            ['id', 'name', 'description'],
            [
                [1, 'Перевязочные материалы', ''],
                [2, 'Диагностическое оборудование', ''],
                [3, 'Средства индивидуальной защиты', ''],
            ]
        );
    }

    public function safeDown()
    {
        $this->delete('categories', ['id' => [1, 2, 3]]);
    }

}
