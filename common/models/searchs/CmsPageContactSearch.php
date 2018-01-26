<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsPageContact;

/**
 * CmsPageContactSearch represents the model behind the search form of `common\models\CmsPageContact`.
 */
class CmsPageContactSearch extends CmsPageContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['phone', 'telephone', 'longitude', 'latitude', 'address', 'map_img', 'email', 'qq', 'zipcode', 'wxopenid', 'weibo', 'banner', 'banner_title', 'banner_subtitle'], 'safe'],
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
        $query = CmsPageContact::find();

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

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'map_img', $this->map_img])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'wxopenid', $this->wxopenid])
            ->andFilterWhere(['like', 'weibo', $this->weibo])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'banner_title', $this->banner_title])
            ->andFilterWhere(['like', 'banner_subtitle', $this->banner_subtitle]);

        return $dataProvider;
    }
}
