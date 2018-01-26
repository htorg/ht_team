<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicesInfo;

/**
 * ServicesInfoSearch represents the model behind the search form of `common\models\ServicesInfo`.
 */
class ServicesInfoSearch extends ServicesInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['settled_image', 'settled_summary', 'settled_desc', 'platform_config1', 'platform_config2', 'platform_config3', 'platform_desc', 'platform_image', 'banner_files'], 'safe'],
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
        $query = ServicesInfo::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'settled_image', $this->settled_image])
            ->andFilterWhere(['like', 'settled_summary', $this->settled_summary])
            ->andFilterWhere(['like', 'settled_desc', $this->settled_desc])
            ->andFilterWhere(['like', 'platform_config1', $this->platform_config1])
            ->andFilterWhere(['like', 'platform_config2', $this->platform_config2])
            ->andFilterWhere(['like', 'platform_config3', $this->platform_config3])
            ->andFilterWhere(['like', 'platform_desc', $this->platform_desc])
            ->andFilterWhere(['like', 'platform_image', $this->platform_image])
            ->andFilterWhere(['like', 'banner_files', $this->banner_files]);

        return $dataProvider;
    }
}
