<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m190507_092403_create_module_test_first_one_table
 */
class m190507_092403_create_module_test_first_one_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $tableOptions = null;

        //Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        //Создание таблицы IP пользователей
        $this->createTable('{{%module_test_first_one}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(15)->notNull(),
            'comment' => $this->string(255),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%module_test_first_one}}');
    }
}
