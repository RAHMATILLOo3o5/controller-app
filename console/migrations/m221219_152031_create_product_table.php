<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m221219_152031_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string(120)->notNull(),
            'amount' => $this->integer()->notNull(),
            'every_amount' => $this->integer()->notNull(),
            'all_amount' => $this->integer()->notNull(),
            'product_purchase_price' => $this->money()->notNull(),
            'type_of_currency' => $this->smallInteger()->defaultValue(0),
            'currency_price' => $this->money()->notNull(),
            'converd_currency'=>$this->money()->notNull(),
            'min_sell_price_retail' => $this->money()->notNull(),
            'max_sell_price_retail' => $this->money()->notNull(),
            'min_sell_price_good' => $this->money()->notNull(),
            'max_sell_price_good' => $this->money()->notNull(),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
