<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "cms_uploadfile".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property integer $site_id
 * @property integer $product_id
 * @property string $name
 * @property string $description
 * @property string $cover
 * @property string $filePath
 * @property integer $status
 */
class CmsUploadFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $img_cover;
	public $upload_file;
    public static function tableName()
    {
        return 'cms_uploadfile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang_id', 'name', 'description', 'cover', 'filePath'], 'required'],
            [['lang_id', 'site_id', 'status','product_id'], 'integer'],
            [['name', 'description', 'cover', 'filePath'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'site_id' => Yii::t('app', 'Site ID'),
        	'product_id'=>	Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'cover' => Yii::t('app', 'Cover'),
            'filePath' => Yii::t('app', 'File Path'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function uploadCover($site_id,$dirName='uploadFile/images')
    {
    	if (empty($this->img_cover))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->img_cover, $site_id, $dirName);
    }
    public function uploadFile($site_id,$dirName='uploadFile/app')
    {
    	if (empty($this->upload_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->upload_file, $site_id, $dirName,1);
    }
}
