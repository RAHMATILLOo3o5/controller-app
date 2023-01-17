<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seller_token}}`.
 */
class m230115_111303_create_seller_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seller_token}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer()->notNull(),
            'token' => $this->string(255)->notNull(),
            'expired_at' => $this->dateTime()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-token-worker_id',
            'seller_token',
            'worker_id',
            'worker',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-token-worker_id',
            'token'
        );
        $this->dropTable('{{%seller_token}}');
    }
}
