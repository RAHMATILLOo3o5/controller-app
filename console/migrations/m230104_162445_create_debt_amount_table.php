<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%debt_amount}}`.
 */
class m230104_162445_create_debt_amount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%debt_amount}}', [
            'id' => $this->primaryKey(),
            'debtor_id' => $this->integer(),
            'all_debt_amount' =>  $this->money(),
            'pay_debt' => $this->money(),
        ]);
        $this->addForeignKey('fk-to-backlog-table', 'debt_amount', 'debtor_id', 'debtor', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-backlog-table', 'debt_amount');
        $this->dropTable('{{%debt_amount}}');
    }
}
