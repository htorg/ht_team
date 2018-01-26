<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsProductInfo;

/**
 * CmsProductInfoSearch represents the model behind the search form of `common\models\CmsProductInfo`.
 */
class CmsProductInfoSearch extends CmsProductInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['main_image', 'main_name', 'main_description', 'address', 'property_area', 'available_area', 'property_properties', 'price', 'node_image', 'node_name', 'node_description'], 'safe'],
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
        $query = CmsProductInfo::find();

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
            'product_id' => $this->product_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'main_image', $this->main_image])
            ->andFilterWhere(['like', 'main_name', $this->main_name])
            ->andFilterWhere(['like', 'main_description', $this->main_description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'property_area', $this->property_area])
            ->andFilterWhere(['like', 'available_area', $this->available_area])
            ->andFilterWhere(['like', 'property_properties', $this->property_properties])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'node_image', $this->node_image])
            ->andFilterWhere(['like', 'node_name', $this->node_name])
            ->andFilterWhere(['like', 'node_description', $this->node_description]);

        return $dataProvider;
    }
}
