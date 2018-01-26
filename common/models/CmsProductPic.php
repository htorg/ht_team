<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "cms_product_pic".
 *
 * @property int $id
 * @property int $product_id
 * @property string $sub_banner
 * @property string $info_img1
 * @property string $info_title1
 * @property string $info_img2
 * @property string $info_title2
 * @property string $info_img3
 * @property string $info_title3
 * @property string $show_pics
 * @property integer $created_at
 * @property integer $updated_at
 */
class CmsProductPic extends \yii\db\ActiveRecord
{
    public $upload_banner;
    public $upload_image1;
    public $upload_image2;
    public $upload_image3;
    public $upload_show_pics;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_product_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'created_at', 'updated_at'], 'integer'],
            [['show_pics'], 'string'],
            [['sub_banner', 'info_img1', 'info_img2', 'info_img3'], 'string', 'max' => 255],
            [['info_title1', 'info_title2', 'info_title3'], 'string', 'max' => 20],
            [['upload_show_pics'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4,'maxSize' => 1024*1024*2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'sub_banner' => Yii::t('app', 'Upload Banner'),
            'info_img1' => Yii::t('app', 'Upload image1'),
            'info_title1' => Yii::t('app', 'Info Title1'),
            'info_img2' => Yii::t('app', 'Upload image2'),
            'info_title2' => Yii::t('app', 'Info Title2'),
            'info_img3' => Yii::t('app', 'Upload image3'),
            'info_title3' => Yii::t('app', 'Info Title3'),
            'show_pics' => Yii::t('app', 'Show Pics'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_banner'=>Yii::t('app', 'Upload Banner'),
            'upload_image1'=> Yii::t('app', 'Upload image1'),
            'upload_image2'=> Yii::t('app', 'Upload image2'),
            'upload_image3'=> Yii::t('app', 'Upload image3'),
            'upload_show_pics'=>Yii::t('app', 'Upload Show Pics'),
        ];
    }
    public function uploadBanner($dirName='product/images')
    {
        if (empty($this->upload_banner))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_banner, $dirName);
    }

    public function uploadImage1($dirName='product/images')
    {
        if (empty($this->upload_image1))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_image1, $dirName);
    }
    public function uploadImage2($dirName='product/images')
    {
        if (empty($this->upload_image2))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_image2, $dirName);
    }
    public function uploadImage3($dirName='product/images')
    {
        if (empty($this->upload_image3))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_image3, $dirName);
    }
    public function uploadImageShowPics($dirName='product/images')
    {
        if (empty($this->upload_show_pics))
        {
            return false;
        }
        $show_pics=[];
        foreach ($this->upload_show_pics as $key=>$val){
            $start=strripos($val->name,'.');
            $name=substr ($val->name, 0,$start);;
            $show_pics[$key]['name']=$name;
            $show_pics[$key]['src']=UtilHelper::upload($val, $dirName)['src'];
        }
        return $show_pics;
    }
}
