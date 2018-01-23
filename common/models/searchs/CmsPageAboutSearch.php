<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsPageAbout;

/**
 * CmsPageAboutSearch represents the model behind the search form about `common\models\CmsPageAbout`.
 */
class CmsPageAboutSearch extends CmsPageAbout
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'site_id', 'status', 'created_at', 'updated_at', 'nav_id'], 'integer'],
            [['company_name', 'company_desc', 'company_slogan', 'company_keywords', 'company_idea', 'company_wish', 'company_culture', 'banner', 'top_banner_name', 'top_banner_desc', 'homepage_name', 'more_btn_name', 'homepage_left_pic'], 'safe'],
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
            'lang_id' => $this->lang_id,
            'site_id' => $this->site_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'nav_id' => $this->nav_id,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_desc', $this->company_desc])
            ->andFilterWhere(['like', 'company_slogan', $this->company_slogan])
            ->andFilterWhere(['like', 'company_keywords', $this->company_keywords])
            ->andFilterWhere(['like', 'company_idea', $this->company_idea])
            ->andFilterWhere(['like', 'company_wish', $this->company_wish])
            ->andFilterWhere(['like', 'company_culture', $this->company_culture])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'top_banner_name', $this->top_banner_name])
            ->andFilterWhere(['like', 'top_banner_desc', $this->top_banner_desc])
            ->andFilterWhere(['like', 'homepage_name', $this->homepage_name])
            ->andFilterWhere(['like', 'more_btn_name', $this->more_btn_name])
            ->andFilterWhere(['like', 'homepage_left_pic', $this->homepage_left_pic]);

        return $dataProvider;
    }
}
