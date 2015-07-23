<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pest_reports".
 *
 * @property string $id
 * @property integer $num_of_pests
 * @property integer $num_of_pests_total
 * @property string $date_time
 * @property string $created_at
 * @property string $updated_at
 * @property string $trap_id
 * @property integer $is_reset
 * @property string $pest_family
 *
 * @property PestFamilies $pestFamily
 * @property Traps $trap
 */
class PestReports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pest_reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_of_pests', 'num_of_pests_total', 'date_time', 'trap_id'], 'required'],
            [['num_of_pests', 'num_of_pests_total', 'trap_id', 'is_reset', 'pest_family'], 'integer'],
            [['date_time', 'created_at', 'updated_at', 'pest_family'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_of_pests' => 'Num Of Pests',
            'num_of_pests_total' => 'Num Of Pests Total',
            'date_time' => 'Date Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'trap_id' => 'Trap ID',
            'is_reset' => 'Is Reset',
            'pest_family' => 'Pest Family',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPestFamily()
    {
        return $this->hasOne(PestFamilies::className(), ['id' => 'pest_family']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrap()
    {
        return $this->hasOne(Traps::className(), ['id' => 'trap_id']);
    }

    /**
     * @inheritdoc
     * @return PestReportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PestReportsQuery(get_called_class());
    }
}
