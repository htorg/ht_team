<?php

namespace common\models\searchs;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsCategory;

/**
 * CmsCategorySearch represents the model behind the search form about `common\models\CmsCategory`.
 */
class CmsCategorySearch extends CmsCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','parent_id', 'status','sort_val','created_at'], 'integer'],
            [['name','type'], 'safe'],
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
        $query = CmsCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($params['type'])){
            $this->type=$params['type'];
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'type'=>$this->type
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        if(!isset($_GET['sort'])){
        	$query->orderBy('sort_val asc,created_at desc');
        }

        return $dataProvider;
    }
}
