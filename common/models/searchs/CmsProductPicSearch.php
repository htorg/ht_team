<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsProductPic;

/**
 * CmsProductPicSearch represents the model behind the search form of `common\models\CmsProductPic`.
 */
class CmsProductPicSearch extends CmsProductPic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['sub_banner', 'info_img1', 'info_title1', 'info_img2', 'info_title2', 'info_img3', 'info_title3', 'show_pics'], 'safe'],
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
        $query = CmsProductPic::find();

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
        ]);

        $query->andFilterWhere(['like', 'sub_banner', $this->sub_banner])
            ->andFilterWhere(['like', 'info_img1', $this->info_img1])
            ->andFilterWhere(['like', 'info_title1', $this->info_title1])
            ->andFilterWhere(['like', 'info_img2', $this->info_img2])
            ->andFilterWhere(['like', 'info_title2', $this->info_title2])
            ->andFilterWhere(['like', 'info_img3', $this->info_img3])
            ->andFilterWhere(['like', 'info_title3', $this->info_title3])
            ->andFilterWhere(['like', 'show_pics', $this->show_pics]);

        return $dataProvider;
    }
}
