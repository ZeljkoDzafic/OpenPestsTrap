<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pest_families".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * @property PestReports[] $pestReports
 */
class PestFamilies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pest_families';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPestReports()
    {
        return $this->hasMany(PestReports::className(), ['pest_family' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PestFamiliesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PestFamiliesQuery(get_called_class());
    }
}
