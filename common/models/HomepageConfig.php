<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "homepage_config".
 *
 * @property int $id
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $copyright
 * @property string $record
 */
class HomepageConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'homepage_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_title', 'copyright', 'record'], 'string', 'max' => 50],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'copyright' => Yii::t('app', 'Copyright'),
            'record' => Yii::t('app', 'Record'),
        ];
    }
}
