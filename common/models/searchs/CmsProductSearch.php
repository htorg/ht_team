<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsProduct;

/**
 * CmsProductSearch represents the model behind the search form of `common\models\CmsProduct`.
 */
class CmsProductSearch extends CmsProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['banner', 'banner_title', 'banner_subtitle', 'main_title', 'second_title', 'product_detail'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CmsProduct::find();

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
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'banner_title', $this->banner_title])
            ->andFilterWhere(['like', 'banner_subtitle', $this->banner_subtitle])
            ->andFilterWhere(['like', 'main_title', $this->main_title])
            ->andFilterWhere(['like', 'second_title', $this->second_title])
            ->andFilterWhere(['like', 'product_detail', $this->product_detail]);

        return $dataProvider;
    }
}
