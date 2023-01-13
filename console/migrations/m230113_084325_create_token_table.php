<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m230113_084325_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string(255)->notNull(),
            'expired_at' => $this->dateTime()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-token-user_id',
            'token',
            'user_id',
            'user',
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
            'fk-token-user_id',
            'token'
        );
        $this->dropTable('{{%token}}');
    }
}
