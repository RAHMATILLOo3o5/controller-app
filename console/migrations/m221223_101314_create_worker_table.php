<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%worker}}`.
 */
class m221223_101314_create_worker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%worker}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'phone_number' => $this->string()->unique()->notNull(),
            'location' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'type' => $this->smallInteger()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%worker}}');
    }
}
