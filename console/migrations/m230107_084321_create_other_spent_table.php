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
