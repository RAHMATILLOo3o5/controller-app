<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%other_spent}}`.
 */
class m230107_084321_create_other_spent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%other_spent}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'summ' => $this->money()->notNull(),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' =>  $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%other_spent}}');
    }
}
