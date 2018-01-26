<?php

namespace common\models;

use common\helpers\UtilHelper;
use Yii;

/**
 * This is the model class for table "upload_files".
 *
 * @property int $id
 * @property string $name
 * @property string $file_type
 * @property string $src
 * @property int $created_at
 * @property int $updated_at
 */
class UploadFiles extends \yii\db\ActiveRecord
{
    public $upload_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upload_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_file'], 'file', 'skipOnEmpty' => true],
            [['file_type', 'src', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'file_type', 'src'], 'string', 'max' => 255],
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
            'file_type' => Yii::t('app', 'File Type'),
            'src' => Yii::t('app', 'Src'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'upload_file'=>Yii::t('app', 'Upload File'),
        ];
    }
    public function uploadFile($dirName='files/images')
    {
        if (empty($this->upload_file))
        {
            return false;
        }
        return UtilHelper::upload($this->upload_file, $dirName,true);
    }
}
