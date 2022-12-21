<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $category_name
 * @property int|null $unit
 * @property int|null $created_at
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['unit', 'created_at'], 'default', 'value' => null],
            [['unit', 'created_at'], 'integer'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Katalog nomi',
            'unit' => 'Birligi kg/dona',
            'created_at' => 'Qo\'shilgan vaqti',
        ];
    }
}
