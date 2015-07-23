<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $image
 * @property integer $trap_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $device_date_time
 *
 * @property Areas[] $areas
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'trap_id'], 'required'],
            [['trap_id'], 'integer'],
            [['created_at', 'updated_at', 'device_date_time'], 'safe'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'trap_id' => 'Trap ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'device_date_time' => 'Device Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Areas::className(), ['image_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }
}
