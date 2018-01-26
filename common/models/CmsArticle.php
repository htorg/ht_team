<?php

namespace common\models;

use Yii;
use common\helpers\UtilHelper;

/**
 * This is the model class for table "cms_article".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $summary
 * @property string $content
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $video_cover
 * @property string $video_src
 * @property string $image_main
 * @property string $image_node
 * @property integer $view_count
 * @property integer $status
 * @property integer $sort_val
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $type
 */
class CmsArticle extends \yii\db\ActiveRecord
{
    const STATUS_DISPLAY=10;
    const STATUS_NONE=0;
    const TYPE_RECOMAND=1;
	public $image_main_file;
	public $image_node_file;
	public $video_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'summary', 'content', 'created_at', 'updated_at','category_id'], 'required'],
            [['category_id', 'view_count', 'status', 'sort_val', 'created_at', 'updated_at','type'], 'integer'],
            [['content'], 'string'],
        	['status','default','value'=>10],
        	['category_id','default','value'=>0],
            [['name', 'summary','video_cover', 'video_src','meta_keywords', 'meta_description', 'image_main', 'image_node'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'summary' => Yii::t('app', 'Summary'),
            'content' => Yii::t('app', 'Content'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'image_main' => Yii::t('app', 'Image Main'),
            'image_node' => Yii::t('app', 'Image Node'),
            'view_count' => Yii::t('app', 'View Count'),
            'status' => Yii::t('app', 'Status'),
            'sort_val' => Yii::t('app', 'Sort Val'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        	'type' => Yii::t('app', 'type'),
        ];
    }
    public function uploadImageMain($dirName='article/images')
    {
    	if (empty($this->image_main_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->image_main_file, $dirName);
    }
    
    public function uploadImageNode($dirName='article/images')
    {
    	if (empty($this->image_node_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->image_node_file,$dirName);
    }
    public function uploadVideoCover($dirName='article/images')
    {
    	if (empty($this->video_file))
    	{
    		return false;
    	}
    	return UtilHelper::upload($this->video_file,$dirName);
    }
    public function getCategory(){
        return $this->hasOne(CmsCategory::className(),['id'=>'category_id']);
    }
    static public function getHomeArticle($type,$amount){
        $list=CmsArticle::find()->joinWith(['category'])->where(['cms_article.status'=>CmsArticle::STATUS_DISPLAY,'cms_category.type'=>$type])
            ->orderBy('updated_at desc')->limit($amount)->asArray()->all();
        return $list;
    }
    static public function getArticleStatus($key=''){
        $status = [self::STATUS_NONE=>'隐藏',self::STATUS_DISPLAY=>'显示'];
        if(!empty($key)){
            return $status[$key];
        }
        return $status;
    }


}
