<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCategory;

/**
 * ProductCategoryQuery represents the model behind the search form of `common\models\ProductCategory`.
 */
class ProductCategoryQuery extends ProductCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit', 'created_at'], 'integer'],
            [['category_name'], 'safe'],
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
        $query = ProductCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'unit' => $this->unit,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'category_name', $this->category_name]);

        return $dataProvider;
    }
}
