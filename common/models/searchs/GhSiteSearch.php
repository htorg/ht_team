<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GhSite;

/**
 * GhSiteSearch represents the model behind the search form about `common\models\GhSite`.
 */
class GhSiteSearch extends GhSite
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'plan_id', 'plan_created_at', 'plan_expired_at', 'status', 'created_at', 'updated_at'], 'integer'],
            [['host_name', 'serial_id'], 'safe'],
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
        $query = GhSite::find();

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
            'user_id' => $this->user_id,
            'type' => $this->type,
            'plan_id' => $this->plan_id,
            'plan_created_at' => $this->plan_created_at,
            'plan_expired_at' => $this->plan_expired_at,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'host_name', $this->host_name])
            ->andFilterWhere(['like', 'serial_id', $this->serial_id]);

        return $dataProvider;
    }
}
