<?php

namespace restapi\controllers;

use yii\rest\Controller;
use common\models\Statistics;
use component\GetCurrency;
use restapi\models\CategoryModel;
use restapi\models\ProductModel;
use restapi\models\SellingModel;
use yii\filters\auth\HttpBearerAuth;

class HomeController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $data = [];
        $product_query = ProductModel::find()->innerJoinWith('category');
        $selling_query = SellingModel::find()->innerJoinWith('category');
        $data['product_amount'] = [
            'unit_kg' => $product_query->where(['product_category.unit' => CategoryModel::UNIT_KG])->sum('all_amount') ?? 0,
            'unit_each' => $product_query->where(['product_category.unit' => CategoryModel::UNIT_EACH])->sum('all_amount') ?? 0
        ];
        $data['sell_product_amount'] = [
            'unit_kg' => $selling_query->where(['product_category.unit' => CategoryModel::UNIT_KG])->sum('sell_amount') ?? 0,
            'unit_each' => $selling_query->where(['product_category.unit' => CategoryModel::UNIT_EACH])->sum('sell_amount') ?? 0
        ];
        $currency = [
            GetCurrency::getData(date('Y-m-d')),
            GetCurrency::getData(date('Y-m-d'), 'EUR'),
            GetCurrency::getData(date('Y-m-d'), 'RUB')
        ];
        $data['currency_value'] = $currency;
        $data['last_month_stat'] = Statistics::find()->where(['>=', 'period', date('Y-m-d H:i', strtotime("-30 days"))])->all();

        return $data;
    }
}
