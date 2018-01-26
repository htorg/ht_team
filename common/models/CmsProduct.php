<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "cms_product".
 *
 * @property int $id
 * @property int $type
 * @property string $banner
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $main_title
 * @property string $second_title
 * @property string $product_detail
 * @property int $created_at
 * @property int $updated_at
 */
class CmsProduct extends \yii\db\ActiveRecord
{
    const TYPE_INDUSTRY=0;
    const TYPE_SHOP=1;
    const TYPE_RESIDENTIAL=2;
    const TYPE_HEAD=3;
    const TYPE_LEASE=4;

    public $upload_banner;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['product_detail'], 'string'],
            [['banner','meta_keywords', 'meta_description'], 'string', 'max' => 255],
            [['banner_title', 'banner_subtitle', 'main_title', 'second_title'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'banner' => Yii::t('app', 'Banner'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'main_title' => Yii::t('app', 'Main Title'),
            'second_title' => Yii::t('app', 'Second Title'),
            'product_detail' => Yii::t('app', 'Product Detail'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
        ];
    }
    public function getInfos(){
        return $this->hasMany(CmsProductInfo::className(),['product_id'=>'id']);
    }
    public function getPics(){
        return $this->hasOne(CmsProductPic::className(),['product_id'=>'id']);
    }
    static public function getProductType($key=''){
        $types=[
            self::TYPE_INDUSTRY=>'产业搂',
            self::TYPE_SHOP=>'商铺',
            self::TYPE_RESIDENTIAL=>'住宅',
            self::TYPE_HEAD=>'总部楼',
            self::TYPE_LEASE=>'租赁'
        ];
        if($key!==''){
            return $types[$key];
        }
        return $types;
    }
    static public function getView($type){
        $view='';
        switch ($type){
            case self::TYPE_INDUSTRY:
                $view='product/industry';
                break;
            case self::TYPE_SHOP:
                $view='product/shop';
                break;
            case self::TYPE_RESIDENTIAL:
                $view='product/residential';
                break;
            case self::TYPE_HEAD:
                $view='product/head';
                break;
            case self::TYPE_LEASE:
                $view='product/lease';
            break;
            default:
                $view='product/industry';
        }
        return $view;
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
