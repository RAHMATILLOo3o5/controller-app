<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statistics".
 *
 * @property int $id
 * @property string $period
 * @property float $total_spent
 * @property float $total_benifit
 * @property float $benifit
 * @property float $differrents
 * @property int|null $created_at
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period', 'total_spent', 'total_benifit', 'benifit', 'differrents'], 'required'],
            [['total_spent', 'total_benifit', 'benifit', 'differrents'], 'number'],
            [['created_at'], 'default', 'value' => null],
            [['created_at'], 'integer'],
            [['period'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period' => 'Statistika davri',
            'total_spent' => 'Xarajatlar',
            'total_benifit' => 'Foyda',
            'benifit' => 'Sof foyda',
            'differrents' => 'Avvalgiga nisbatan',
            'created_at' => 'Natija olingan vaqt',
        ];
    }

    public function getTotalProfit()
    {
        $arr = [];

        $r = self::find()->orderBy(['id' => SORT_DESC])->all();

        foreach ($r as $k){
            $arr[] = $k->total_benifit;
        }

        return json_encode($arr);

    }

    public function getPeriodData()
    {
        $arr = [];

        $r = self::find()->orderBy(['id' => SORT_DESC])->all();

        foreach ($r as $k){
            $arr[] = date('m/d/Y', $k->created_at)." GTM";
        }

        return json_encode($arr);
    }

    public function getProBenefit()
    {
        $arr = [];

        $r = self::find()->orderBy(['id' => SORT_DESC])->all();

        foreach ($r as $k){
            $arr[] = $k->benifit;
        }

        return json_encode($arr);
    }

    public function getTotalExpens()
    {
        $arr = [];

        $r = self::find()->orderBy(['id' => SORT_DESC])->all();

        foreach ($r as $k){
            $arr[] = $k->total_spent;
        }

        return json_encode($arr);
    }
}
