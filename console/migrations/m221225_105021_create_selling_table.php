<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%selling}}`.
 */
class m221225_105021_create_selling_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%selling}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'product_id' => $this->integer(),
            'worker_id' => $this->integer(),
            'sell_price' => $this->integer()->notNull(),
            'sell_amount' => $this->integer()->notNull(),
            'type_sell' => $this->smallInteger()->defaultValue(0),
            'type_pay' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-to-product-tb',
            'selling',
            'product_id',
            'product',
            'id'
        );
        $this->addForeignKey(
            'fk-to-product_category-tb',
            'selling',
            'category_id',
            'product_category',
            'id'
        );
        $this->addForeignKey(
            'fk-to-worker-tb',
            'selling',
            'worker_id',
            'worker',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-to-product-tb',
            'selling'
        );
        $this->dropForeignKey(
            'fk-to-product_category-tb',
            'selling'
        );
        $this->dropForeignKey(
            'fk-to-worker-tb',
            'selling'
        );
        $this->dropTable('{{%selling}}');
    }
}
