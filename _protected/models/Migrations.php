<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "migrations".
 *
 * @property string $migration
 * @property integer $batch
 */
class Migrations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'migrations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['migration', 'batch'], 'required'],
            [['batch'], 'integer'],
            [['migration'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'migration' => 'Migration',
            'batch' => 'Batch',
        ];
    }

    /**
     * @inheritdoc
     * @return MigrationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MigrationsQuery(get_called_class());
    }
}
