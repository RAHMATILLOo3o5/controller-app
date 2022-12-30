<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%backlog}}`.
 */
class m221228_150832_create_backlog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%backlog}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer(),
            'selling_id' => $this->integer(),
            'debtor_id' => $this->integer(),
            'backlog_amount' => $this->money(),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-from-backlog-to-worker', 'backlog', 'worker_id', 'worker', 'id', 'CASCADE');
        $this->addForeignKey('fk-from-backlog-to-selling', 'backlog', 'selling_id', 'selling', 'id', 'CASCADE');
        $this->addForeignKey('fk-from-backlog-to-debtor', 'backlog', 'debtor_id', 'debtor', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-from-backlog-to-worker', 'backlog');
        $this->dropForeignKey('fk-from-backlog-to-selling', 'backlog');
        $this->dropForeignKey('fk-from-backlog-to-debtor', 'backlog');
        $this->dropTable('{{%backlog}}');
    }
}
