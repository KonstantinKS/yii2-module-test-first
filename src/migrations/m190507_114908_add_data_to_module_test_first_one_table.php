<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m190507_114908_add_data_to_module_test_first_one_table
 */
class m190507_114908_add_data_to_module_test_first_one_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $columns = [
            'ip',
            'comment',
        ];

        $rows = [
            ['1111111', 'comment 11111111'],
            ['2222222', 'comment 22222222'],
            ['3333333', 'comment 33333333'],
            ['4444444', 'comment 44444444'],
            ['5555555', 'comment 55555555'],
        ];

        $this->batchInsert('{{%module_test_first_one}}', $columns, $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->truncateTable('{{%module_test_first_one}}');
    }
}
