<?php

namespace restapi\controllers;

use common\models\Selling;
use yii\rest\Controller;
use common\models\Statistics;
use restapi\models\CategoryModel;
use restapi\models\ProductModel;

class HomeController extends Controller
{

    public function actionIndex()
    {
        $data = [];
        $product_query = ProductModel::find()->innerJoinWith('category');
        $selling_query = Selling::find()->innerJoin('product.category');
        $data['product_amount'] = [
            'unit_kg' => $product_query->where(['product_category.unit' => CategoryModel::UNIT_KG])->sum('all_amount') ?? 0,
            'unit_each' => $product_query->where(['product_category.unit' => CategoryModel::UNIT_EACH])->sum('all_amount') ?? 0
        ];
        $data['sell_product_amount'] = [
            'unit_kg' => $selling_query->where(['product_category.unit' => CategoryModel::UNIT_KG])->sum('sell_amount') ?? 0,
            'unit_each' => $selling_query->where(['product_category.unit' => CategoryModel::UNIT_EACH])->sum('sell_amount') ?? 0
        ];
        $data['last_month_stat'] = Statistics::find()->where(['>=', 'period', date('Y-m-d H:i', strtotime("-30 days"))])->all();

        return $data;
    }
}
