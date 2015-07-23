<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property string $id
 * @property string $x
 * @property string $y
 * @property string $width
 * @property string $height
 * @property string $radius
 * @property integer $is_circle
 * @property string $image_id
 *
 * @property Images $image
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['x', 'y', 'width', 'height', 'radius', 'is_circle', 'image_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'x' => 'X',
            'y' => 'Y',
            'width' => 'Width',
            'height' => 'Height',
            'radius' => 'Radius',
            'is_circle' => 'Is Circle',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @inheritdoc
     * @return AreasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreasQuery(get_called_class());
    }
}
