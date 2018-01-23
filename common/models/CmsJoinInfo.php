<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cms_join_info".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $lang_id
 * @property string $name
 * @property integer $phone
 * @property string $mail
 * @property string $content
 * @property integer $created_at
 * @property integer $status
 * @property integer $type
 */
class CmsJoinInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_join_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'lang_id','created_at'], 'required'],
            [['site_id', 'lang_id', 'phone', 'created_at', 'status','type'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 10],
            [['mail'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_id' => Yii::t('app', 'Site ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'mail' => Yii::t('app', 'Mail'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        	'type'=>\Yii::t('app', 'Type')	
        ];
    }
}
