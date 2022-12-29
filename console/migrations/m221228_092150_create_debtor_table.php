<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%debtor}}`.
 */
class m221228_092150_create_debtor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%debtor}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'author_id' => $this->integer()
        ]);
        $this->addForeignKey('fk-from-debtor-to-worker', 'debtor', 'author_id', 'worker', 'id', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-from-debtor-to-worker', 'debtor');
        $this->dropTable('{{%debtor}}');
    }
}
