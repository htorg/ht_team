<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cms_listed_company".
 *
 * @property int $id
 * @property int $about_id
 * @property string $company_name 上市公司
 * @property string $listing_place 上市地点
 * @property string $stock_code 股票代码
 * @property string $rank_field 行业地位
 * @property int $created_at
 * @property int $updated_at
 */
class CmsListedCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_listed_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about_id', 'company_name', 'listing_place', 'stock_code', 'rank_field', 'created_at', 'updated_at'], 'required'],
            [['about_id', 'created_at', 'updated_at'], 'integer'],
            [['company_name', 'listing_place', 'stock_code'], 'string', 'max' => 20],
            [['rank_field'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'about_id' => Yii::t('app', 'About ID'),
            'company_name' => Yii::t('app', 'Company Name'),
            'listing_place' => Yii::t('app', 'Listing Place'),
            'stock_code' => Yii::t('app', 'Stock Code'),
            'rank_field' => Yii::t('app', 'Rank Field'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
