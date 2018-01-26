<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "cms_banner_pic".
 *
 * @property int $id
 * @property string $banner_title
 * @property string $banner_subtitle
 * @property string $pos
 * @property string $image
 * @property string $link
 * @property int $sort_val
 * @property int $created_at
 * @property int $updated_at
 */
class CmsBannerPic extends \yii\db\ActiveRecord
{
    const POS_HOMEPAGE='homepage';
    public $image_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_banner_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pos', 'image', 'link', 'created_at', 'updated_at'], 'required'],
            [['sort_val', 'created_at', 'updated_at'], 'integer'],
            [['image', 'link','banner_title', 'banner_subtitle'], 'string', 'max' => 255],
            [['sort_val'], 'default', 'value'=>10],
            [['pos'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pos' => Yii::t('app', 'Pos'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'banner_title' => Yii::t('app', 'Banner Title'),
            'banner_subtitle' => Yii::t('app', 'Banner Subtitle'),
            'sort_val' => Yii::t('app', 'Sort Val'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'image_file' => Yii::t('app', 'Image'),
        ];
    }
    public function uploadImage($dirName='banner/images')
    {
        if (empty($this->image_file))
        {
            return false;
        }
        return UtilHelper::upload($this->image_file,$dirName);
    }
}
