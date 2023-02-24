<?php

namespace restapi\modules\seller\controllers;

use Yii;
use yii\filters\Cors;
use yii\rest\Controller;
use common\models\DebtAmount;
use common\models\Selling;
use restapi\models\SellingModel;
use yii\filters\auth\HttpBearerAuth;
use restapi\modules\seller\models\DebtorModel;

class OrderController extends Controller
{
    public $defaultAction = 'order';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,

        ];

        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function actionOrder()
    {
        $data = [];
        $data['order'] = SellingModel::find()->orderBy(['id' => SORT_ASC])->all();
        $data['debtors'] = DebtorModel::find()->orderBy(['id' => SORT_ASC])->all();
        if ($this->request->isPost) {
            $orders = Yii::$app->request->post("orderList")['order'];
            $debtor = Yii::$app->request->post("orderList")['debtor'];

            if ($debtor === null) {
                return $this->orderSave($orders);
            } else {
                return $this->orderSave($orders) && $this->debtorSave($debtor);
            }
        }
        return $data;
    }

    public function orderSave(array $data)
    {
        $model = new Selling();
        $r = [];
        foreach ($data as $k) {
            $model->sell_price = $k['sell_price'];
            $model->category_id = $k['category_id'];
            $model->product_id = $k['product_id'];
            $model->sell_price = $k['sell_price'];
            $model->sell_amount = $k['sell_amount'];
            $model->type_sell = $k['type_sell'];
            $model->type_pay = $k['type_pay'];
            $r[] = $model->save();
        }
        return $r;
    }

    /**
     * debtorSave
     *
     * @param  mixed $data
     * @return bool
     */
    public function debtorSave(array $data)
    {
        $model = new DebtorModel();
        $debt = new DebtAmount();
        $model->full_name = $data['full_name'];
        $model->location = $data['location'];
        $model->phone_number = $data['phone_number'];
        $model->status = $model::ACTIVE;
        $model->save();
        $debt->debtor_id = $model->id;
        $debt->all_debt_amount = $data['payment_amount'];
        $debt->pay_debt = $data['sell_price'];
        return $debt->save();
    }
}
