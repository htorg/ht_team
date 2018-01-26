<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsPageAbout;

/**
 * CmsPageAboutSearch represents the model behind the search form of `common\models\CmsPageAbout`.
 */
class CmsPageAboutSearch extends CmsPageAbout
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['banner', 'banner_title', 'banner_subtitle', 'company_name', 'company_desc', 'shareholder_title', 'shareholder_detail', 'Strategic_title', 'Strategic_detail', 'info_main_title', 'info_subtitle', 'info_desc1', 'info_desc2', 'info_desc3', 'shareholder_info_title'], 'safe'],
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
        $query = CmsPageAbout::find();

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

        $query->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'banner_title', $this->banner_title])
            ->andFilterWhere(['like', 'banner_subtitle', $this->banner_subtitle])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_desc', $this->company_desc])
            ->andFilterWhere(['like', 'shareholder_title', $this->shareholder_title])
            ->andFilterWhere(['like', 'shareholder_detail', $this->shareholder_detail])
            ->andFilterWhere(['like', 'Strategic_title', $this->Strategic_title])
            ->andFilterWhere(['like', 'Strategic_detail', $this->Strategic_detail])
            ->andFilterWhere(['like', 'info_main_title', $this->info_main_title])
            ->andFilterWhere(['like', 'info_subtitle', $this->info_subtitle])
            ->andFilterWhere(['like', 'info_desc1', $this->info_desc1])
            ->andFilterWhere(['like', 'info_desc2', $this->info_desc2])
            ->andFilterWhere(['like', 'info_desc3', $this->info_desc3])
            ->andFilterWhere(['like', 'shareholder_info_title', $this->shareholder_info_title]);

        return $dataProvider;
    }
}
