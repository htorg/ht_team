<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "friend_link".
 *
 * @property int $id
 * @property string $name
 * @property string $site_url
 * @property string $logo
 * @property int $created_at
 * @property int $updated_at
 */
class FriendLink extends \yii\db\ActiveRecord
{
    public $upload_logo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'site_url', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'site_url' => Yii::t('app', 'Site Url'),
            'logo' => Yii::t('app', 'Logo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function uploadLogo($dirName='entering/logo')
    {
        if (empty($this->upload_logo))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_logo,$dirName);
    }
    static public function getHomeEnterings($amount){
       $list=FriendLink::find()->limit($amount)->asArray()->all();
       return $list;
    }
}
