<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductQuery represents the model behind the search form of `common\models\Product`.
 */
class ProductQuery extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'every_amount', 'all_amount', 'product_purchase_price', 'type_of_currency', 'status', 'created_at', 'updated_at'], 'integer'],
            [['product_name'], 'safe'],
            [['currency_price', 'min_sell_price_retail', 'max_sell_price_retail', 'min_sell_price_good', 'max_sell_price_good'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'every_amount' => $this->every_amount,
            'all_amount' => $this->all_amount,
            'product_purchase_price' => $this->product_purchase_price,
            'type_of_currency' => $this->type_of_currency,
            'currency_price' => $this->currency_price,
            'min_sell_price_retail' => $this->min_sell_price_retail,
            'max_sell_price_retail' => $this->max_sell_price_retail,
            'min_sell_price_good' => $this->min_sell_price_good,
            'max_sell_price_good' => $this->max_sell_price_good,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'product_name', $this->product_name]);

        return $dataProvider;
    }
}
