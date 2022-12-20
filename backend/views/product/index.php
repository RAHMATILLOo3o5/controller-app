<?php

use common\models\Product;
use kartik\export\ExportMenu;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;


/** @var yii\web\View $this */
/** @var common\models\search\ProductQuery $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    // 'id',
    'product_name',
    [
        'attribute' => 'amount',
        'value' => 'amountFormat'
    ],
    [
        'attribute' => 'every_amount',
        'value' => 'everyAmountFormat'
    ],
    [
        'attribute' => 'all_amount',
        'value' => 'allAmountFormat'
    ],
    [
        'attribute' => 'product_purchase_price',
        'value' => 'productPurchasePrice'
    ],
    [
        'attribute' => 'type_of_currency',
        'value' => 'currencyFormat',
        'format' => 'html'
    ],
    [
        'attribute' => 'currency_price',
        'value' => 'currencyValue'
    ],
    [
        'attribute' => 'converd_currency',
        'value' => 'currencyConverd'
    ],
    [
        'attribute' => 'min_sell_price_retail',
        'value' => 'minSellPriceRetail'
    ],
    [
        'attribute' => 'max_sell_price_retail',
        'value' => 'maxSellPriceRetail'
    ],
    [
        'attribute' => 'min_sell_price_good',
        'value' => 'minSellPriceGood'
    ],
    [
        'attribute' => 'max_sell_price_good',
        'value' => 'maxSellPriceGood'
    ],
    // 'status',
    'created_at:date',
    // 'updated_at:date',
];
?>
<div class="row">
    <div class="col-12">
        <h2 class="mb-2 page-title"><?= Html::encode($this->title) ?></h2>
        <div class="card p-2">
            <div class="card-header">
                <span>
                    <?= Html::a('Mahsulot qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
                </span>
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'dropdownOptions' => [
                        'label' => 'Saqlash',
                        'class' => 'btn btn-outline-secondary btn-default'
                    ],
                    'exportConfig' => [
                        ExportMenu::FORMAT_TEXT => false,
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_EXCEL => false,
                        ExportMenu::FORMAT_CSV => false,
                    ],
                    'filename' => $this->title,
                    'boxStyleOptions' => [
                        ExportMenu::FORMAT_EXCEL_X => [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => 'solid',
                                ],
                                'inside' => [
                                    'borderStyle' => 'sollid',
                                ],
                            ],
                        ],
                    ]
                ]) ?>
                <b class="ml-md-5">Mahsulotlar uchun sarflangan jami summa: <?= number_format($allMoney, 2, '.', ' ') ?> so'm</b>
            </div>
            <?php Pjax::begin(); ?>

            <div class="card-body p-0">
                <div class="table-responsive">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => false,
                        'tableOptions' => [
                            'class' => 'table',
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'product_name',
                            [
                                'attribute' => 'amount',
                                'value' => 'amountFormat'
                            ],
                            [
                                'attribute' => 'every_amount',
                                'value' => 'everyAmountFormat'
                            ],
                            [
                                'attribute' => 'all_amount',
                                'value' => 'allAmountFormat'
                            ],
                            [
                                'attribute' => 'product_purchase_price',
                                'value' => 'productPurchasePrice'
                            ],
                            [
                                'attribute' => 'type_of_currency',
                                'value' => 'currencyFormat',
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'currency_price',
                                'value' => 'currencyValue',
                                'label' => 'Valyuta narxi'
                            ],
                            [
                                'attribute' => 'converd_currency',
                                'value' => 'currencyConverd',
                            ],
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'buttons' => [
                                    'view' => function ($url) {
                                        return Html::a('<i class="fe fe-eye"></i>', $url, ['class' => 'btn btn-info btn-sm']);
                                    },
                                    'update' => function ($url) {
                                        return Html::a('<i class="fe fe-pen-tool"></i>', $url, ['class' => 'btn btn-primary btn-sm']);
                                    },
                                    'delete' => function ($url) {
                                        return Html::a('<i class="fe fe-trash"></i>', $url, ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']);
                                    }
                                ],
                            ],
                        ],
                        'pager' => [
                            'class' => LinkPager::class
                        ]
                    ]); ?>
                </div>
            </div>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>