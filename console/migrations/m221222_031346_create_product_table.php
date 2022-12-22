<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m221222_031346_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'product_name' => $this->string(120)->notNull(),
            'amount' => $this->integer()->defaultValue(0),
            'every_amount' => $this->integer()->defaultValue(0),
            'all_amount' => $this->integer()->notNull(),
            'product_purchase_price' => $this->money()->notNull(),
            'type_of_currency' => $this->smallInteger()->defaultValue(0),
            'currency_price' => $this->money()->notNull(),
            'converd_currency' => $this->money()->notNull(),
            'min_sell_price_retail' => $this->money()->notNull(),
            'max_sell_price_retail' => $this->money()->notNull(),
            'min_sell_price_good' => $this->money()->notNull(),
            'max_sell_price_good' => $this->money()->notNull(),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-to-product-category-table', 'product', 'category_id', 'product_category', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-product-category-table', 'product');
        $this->dropTable('{{%product}}');
    }
}
