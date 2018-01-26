<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;
/**
 * This is the model class for table "cms_page_about".
 *
 * @property int $id
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $banner
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $company_name
 * @property string $company_desc
 * @property string $shareholder_title
 * @property string $shareholder_detail
 * @property string $Strategic_title
 * @property string $Strategic_detail
 * @property string $info_main_title
 * @property string $info_subtitle
 * @property string $info_desc1
 * @property string $info_desc2
 * @property string $info_desc3
 * @property string $shareholder_info_title
 * @property int $created_at
 * @property int $updated_at
 */
class CmsPageAbout extends \yii\db\ActiveRecord
{
    public $upload_banner;
    public $upload_strategic;
    public $upload_shareholder;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_page_about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'company_desc',  'shareholder_detail',  'Strategic_detail',  'info_desc1', 'info_desc2', 'info_desc3', 'created_at', 'updated_at'], 'required'],
            [['company_desc'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['banner', 'banner_title', 'banner_subtitle', 'meta_keywords', 'meta_description','company_name', 'shareholder_detail', 'Strategic_detail'], 'string', 'max' => 255],
            [['shareholder_title', 'Strategic_title', 'info_main_title', 'info_subtitle', 'shareholder_info_title'], 'string', 'max' => 50],
            [['info_desc1', 'info_desc2', 'info_desc3'], 'string', 'max' => 25],
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
            'company_name' => Yii::t('app', 'Company Name'),
            'company_desc' => Yii::t('app', 'Company Desc'),
            'shareholder_title' => Yii::t('app', 'Shareholder Title'),
            'shareholder_detail' => Yii::t('app', 'Shareholder Detail'),
            'Strategic_title' => Yii::t('app', 'Strategic Title'),
            'Strategic_detail' => Yii::t('app', 'Strategic Detail'),
            'info_main_title' => Yii::t('app', 'Info Main Title'),
            'info_subtitle' => Yii::t('app', 'Info Subtitle'),
            'info_desc1' => Yii::t('app', 'Info Desc1'),
            'info_desc2' => Yii::t('app', 'Info Desc2'),
            'info_desc3' => Yii::t('app', 'Info Desc3'),
            'shareholder_info_title' => Yii::t('app', 'Shareholder Info Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
            'upload_strategic'=>Yii::t('app', 'Upload Strategic'),
            'upload_shareholder'=>Yii::t('app', 'Upload Shareholder'),

        ];
    }
    public function getCompany(){
        return $this->hasMany(CmsListedCompany::className(),['about_id'=>'id']);
    }
    public function uploadBanner($dirName='about/images')
    {
        if (empty($this->upload_banner))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_banner,$dirName);
    }
    public function uploadStrategic($dirName='about/images')
    {
        if (empty($this->upload_strategic))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_strategic,$dirName);
    }
    public function uploadShareholder($dirName='about/images')
    {
        if (empty($this->upload_shareholder))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_shareholder,$dirName);
    }
}
