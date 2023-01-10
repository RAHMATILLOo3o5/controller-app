<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistics}}`.
 */
class m230109_151847_create_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistics}}', [
            'id' => $this->primaryKey(),
            'period' => $this->string()->notNull(),
            'total_spent' => $this->money()->notNull(),
            'total_benifit' => $this->money()->notNull(),
            'benifit' => $this->money()->notNull(),
            'differrents' => $this->money()->notNull(), 
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistics}}');
    }
}
