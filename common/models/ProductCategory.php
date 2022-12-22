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

    const UNIT_KG = 0;
    const UNIT_EACH = 1;

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
            [['unit', 'created_at'], 'default', 'value' => 0],
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

    public function getUnitVal(): array
    {
        $unit = [
            static::UNIT_KG => 'KG',
            static::UNIT_EACH => 'DONA',
        ];

        return $unit;
    }

    public function getUnitLabel(): string
    {
        if($this->unit == static::UNIT_KG){
            return "<span class='badge badge-info ml-1'> KG</span>";
        } else{
            return "<span class='badge badge-primary ml-1'> DONA</span>";
        }
    }
}
