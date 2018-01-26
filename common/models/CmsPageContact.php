<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "cms_page_contact".
 *
 * @property int $id
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $phone
 * @property string $telephone
 * @property string $longitude
 * @property string $latitude
 * @property string $address
 * @property string $map_img
 * @property string $email
 * @property string $qq
 * @property string $zipcode
 * @property string $wxopenid
 * @property string $weibo
 * @property string $banner
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $contact_desc
 * @property int $created_at
 * @property int $updated_at
 */
class CmsPageContact extends \yii\db\ActiveRecord
{
    public $upload_banner;
    public $upload_weixin;
    public $upload_weibo;
    public $upload_map;

    const TYPE_COMPANY=0;
    const TYPE_PROPERTY=1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_page_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'address', 'created_at', 'updated_at','type'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['phone', 'telephone', 'zipcode'], 'string', 'max' => 20],
            [['longitude', 'latitude'], 'string', 'max' => 40],
            [['address'], 'string', 'max' => 200],
            [['map_img', 'wxopenid', 'meta_keywords', 'meta_description', 'weibo','qq','banner', 'banner_title', 'banner_subtitle'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 60],
            [['contact_desc'], 'string'],
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
            'phone' => Yii::t('app', 'Phone'),
            'telephone' => Yii::t('app', 'Telephone'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'address' => Yii::t('app', 'Address'),
            'map_img' => Yii::t('app', 'Map Img'),
            'email' => Yii::t('app', 'Email'),
            'qq' => Yii::t('app', 'Qq'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'wxopenid' => Yii::t('app', 'Wxopenid'),
            'weibo' => Yii::t('app', 'Weibo'),
            'banner' => Yii::t('app', 'Banner'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'contact_desc'=>Yii::t('app', 'Contact Desc'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
            'upload_weixin'=>Yii::t('app', 'Upload Weixin'),
            'upload_weibo'=>Yii::t('app', 'Upload Weibo'),
            'upload_map'=>Yii::t('app', 'Upload Map'),
        ];
    }
    public function uploadBanner($dirName='contact/images')
    {
        if (empty($this->upload_banner))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_banner,$dirName);
    }
    public function uploadWeixin($dirName='contact/images')
    {
        if (empty($this->upload_weixin))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_weixin,$dirName);
    }
    public function uploadWeibo($dirName='contact/images')
    {
        if (empty($this->upload_weibo))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_weibo,$dirName);
    }
    public function uploadMap($dirName='contact/images')
    {
        if (empty($this->upload_map))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_map,$dirName);
    }
    static public function getContactType($key=''){
        $types=[
                self::TYPE_COMPANY=>'联系我们',
                self::TYPE_PROPERTY=>'物业服务'
            ];
        if ($key!==''){
            return $types[$key];
        }
        return $types;
    }
}
