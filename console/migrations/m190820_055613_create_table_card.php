<?php

use yii\db\Migration;

class m190820_055613_create_table_card extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        echo $this->getDb()->dsn . PHP_EOL;
        $this->createTable('{{%card}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250),
            'description' => $this->text(),
            'views_count' => $this->integer()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown()
    {
        echo $this->getDb()->dsn . PHP_EOL;
        $this->dropTable('{{%card}}');
    }
}
