<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "services_info".
 *
 * @property int $id
 * @property string $banner
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $settled_image
 * @property string $settled_summary
 * @property string $settled_desc
 * @property string $platform_config1
 * @property string $platform_config2
 * @property string $platform_config3
 * @property string $platform_desc
 * @property string $platform_image
 * @property string $banner_files
 * @property int $created_at
 * @property int $updated_at
 */
class ServicesInfo extends \yii\db\ActiveRecord
{
    public $upload_banner;
    public $upload_settled_image;
    public $upload_platform_image;
    public $upload_banners;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['settled_image', 'settled_summary', 'settled_desc', 'platform_config1', 'platform_config2', 'platform_config3', 'platform_image', 'banner_files', 'created_at', 'updated_at'], 'required'],
            [['settled_desc', 'settled_summary', 'banner_files'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['settled_image','platform_desc','banner_title', 'banner_subtitle','platform_config1', 'platform_config2', 'platform_config3',  'platform_image'], 'string', 'max' => 255],
            [['upload_banners'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5,'maxSize' => 1024*1024*2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'settled_image' => Yii::t('app', 'Settled Image'),
            'settled_summary' => Yii::t('app', 'Settled Summary'),
            'settled_desc' => Yii::t('app', 'Settled Desc'),
            'platform_config1' => Yii::t('app', 'Platform Config1'),
            'platform_config2' => Yii::t('app', 'Platform Config2'),
            'platform_config3' => Yii::t('app', 'Platform Config3'),
            'platform_desc' => Yii::t('app', 'Platform Desc'),
            'platform_image' => Yii::t('app', 'Platform Image'),
            'banner_files' => Yii::t('app', 'Settled Banner Files'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'upload_settled_image'=> Yii::t('app', 'Upload Settled Image'),
            'upload_platform_image'=>Yii::t('app', 'Platform Image'),
            'upload_banners'=>Yii::t('app', 'Upload Banners'),
        ];
    }
    public function uploadSettledBanner($dirName='services/images')
    {
        if (empty($this->upload_banner))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_banner, $dirName);
    }
    public function uploadSettledImage($dirName='services/images')
    {
        if (empty($this->upload_settled_image))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_settled_image, $dirName);
    }
    public function uploadPlatformImage($dirName='services/images')
    {
        if (empty($this->upload_platform_image))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_platform_image, $dirName);
    }
        public function uploadBanner($dirName='services/images')
    {
        if (empty($this->upload_banners))
        {
            return false;
        }
        $banners=[];
        foreach ($this->upload_banners as $key=>$val){
            $banners[$key]['src']=UtilHelper::upload($val, $dirName)['src'];
        }
        return $banners;
    }
}
