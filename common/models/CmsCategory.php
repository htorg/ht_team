<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "cms_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $image_main
 * @property string $image_node
 * @property string $banner
 * @property integer $sort_val
 * @property integer $status
 * @property string $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class CmsCategory extends \yii\db\ActiveRecord
{
    //栏目状态
    const STATUS_DISPLAY=10;
    const STATUS_NONE=0;
    //栏目类型
    const TYPE_NEWS=0;//新闻资讯
    const TYPE_PARK=1;//园区概述
    const TYPE_OPERATE=2;//物业服务
    const TYPE_INDEX=3;//首页企业生态圈

	public $image_main_file;
	public $image_node_file;
	public $banner_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_val', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'created_at', 'updated_at'], 'required'],
            [['name','banner_title','banner_subtitle', 'description', 'meta_keywords', 'meta_description', 'image_main', 'image_node', 'banner'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
        	['parent_id', 'default', 'value' =>0],
        	['status', 'default', 'value' =>10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'description' => Yii::t('app', 'Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'image_main' => Yii::t('app', 'Image Main'),
            'image_node' => Yii::t('app', 'Image Node'),
            'banner' => Yii::t('app', 'Banner'),
            'sort_val' => Yii::t('app', 'Sort Val'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function getArticles(){
        return $this->hasMany(CmsArticle::className(),['category_id'=>'id']);
    }
    public function uploadImageMain($dirName='category/images')
    {
    	if (empty($this->image_main_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->image_main_file, $dirName);
    }
    
    public function uploadImageNode($dirName='category/images')
    {
    	if (empty($this->image_node_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->image_node_file,$dirName);
    }
    
    public function uploadBanner($dirName='category/images')
    {
    	if (empty($this->banner_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->banner_file, $dirName);
    }
    public function getArticle(){
        return $this->hasMany(CmsArticle::className(),['id'=>'categroy_id'])->limit(4);
    }
    static public function getCategoryStatus($key=''){
        $status = [self::STATUS_NONE=>'有效',self::STATUS_DISPLAY=>'无效'];
        if($key!==''){
            return $status[$key];
        }
        return $status;
    }
    static public function getCategoryType($key=''){
        $types=[
            self::TYPE_NEWS=>'新闻资讯',
            self::TYPE_PARK=>'园区概述',
            self::TYPE_OPERATE=>'物业服务',
            self::TYPE_INDEX=>'首页企业生态圈'
        ];
        if($key!==''){
            return $types[$key];
        }
        return $types;
    }
}
