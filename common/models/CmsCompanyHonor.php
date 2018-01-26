<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "cms_company_honor".
 *
 * @property int $id
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $banner
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $honor_country
 * @property string $honor_provice
 * @property string $link_country
 * @property string $link_provice
 * @property int $created_at
 * @property int $updated_at
 */
class CmsCompanyHonor extends \yii\db\ActiveRecord
{
    public $upload_banner;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_company_honor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['honor_country', 'honor_provice', 'link_country', 'link_provice', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['honor_country', 'honor_provice',], 'string'],
            [['banner', 'banner_title', 'meta_keywords', 'meta_description',  'banner_subtitle','link_country', 'link_provice'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'banner' => Yii::t('app', 'Banner'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'honor_country' => Yii::t('app', 'Honor Country'),
            'honor_provice' => Yii::t('app', 'Honor Provice'),
            'link_country' => Yii::t('app', 'Link Country'),
            'link_provice' => Yii::t('app', 'Link Provice'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
        ];
    }
    public function uploadBanner($dirName='about/images')
    {
        if (empty($this->upload_banner))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_banner,$dirName);
    }
}
