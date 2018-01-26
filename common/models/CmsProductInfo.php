<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "cms_product_info".
 *
 * @property int $id
 * @property int $product_id
 * @property string $main_image
 * @property string $main_name
 * @property string $main_description
 * @property string $address
 * @property string $property_area
 * @property string $available_area
 * @property string $property_properties
 * @property string $price
 * @property string $node_image
 * @property string $node_name
 * @property string $node_description
 * @property int $created_at
 * @property int $updated_at
 */
class CmsProductInfo extends \yii\db\ActiveRecord
{
    public $upload_main_image;
    public $upload_node_image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_product_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'main_image', 'main_name', 'main_description', 'created_at', 'updated_at'], 'required'],
            [['product_id', 'created_at', 'updated_at'], 'integer'],
            [['main_description', 'node_description'], 'string'],
            [['main_image', 'node_image'], 'string', 'max' => 255],
            [['main_name', 'address', 'property_area', 'property_properties', 'price'], 'string', 'max' => 20],
            [['available_area', 'node_name'], 'string', 'max' => 50],
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
            'main_image' => Yii::t('app', 'Main Image'),
            'main_name' => Yii::t('app', 'Main Name'),
            'main_description' => Yii::t('app', 'Main Description'),
            'address' => Yii::t('app', 'Address'),
            'property_area' => Yii::t('app', 'Property Area'),
            'available_area' => Yii::t('app', 'Available Area'),
            'property_properties' => Yii::t('app', 'Property Properties'),
            'price' => Yii::t('app', 'Price'),
            'node_image' => Yii::t('app', 'Node Image'),
            'node_name' => Yii::t('app', 'Node Name'),
            'node_description' => Yii::t('app', 'Node Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_main_image'=> Yii::t('app', 'Upload Main Image'),
            'upload_node_image'=> Yii::t('app', 'Upload Node Image'),
        ];
    }
    public function uploadMainImage($dirName='product/images')
    {
        if (empty($this->upload_main_image))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_main_image,$dirName);
    }
    public function uploadNodeImage($dirName='product/images')
    {
        if (empty($this->upload_node_image))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_node_image,$dirName);
    }
}
