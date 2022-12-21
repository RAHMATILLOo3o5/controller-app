<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 */
class m221221_101408_create_product_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'category_name' =>  $this->string()->notNull(),
            'unit' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_category}}');
    }
}
