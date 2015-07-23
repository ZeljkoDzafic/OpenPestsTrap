<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "traps".
 *
 * @property string $id
 * @property string $name
 * @property string $pests_network_id
 * @property string $uuid
 * @property string $latitude
 * @property string $longitude
 * @property string $battery_charge
 * @property string $startdate
 * @property string $enddate
 * @property string $status
 * @property string $description
 * @property string $user_id
 * @property string $created_at
 * @property integer $is_running
 * @property integer $is_public
 * @property string $error_code
 * @property string $updated_at
 *
 * @property PestReports[] $pestReports
 * @property TrapNetworks $pestsNetwork
 */
class Traps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'traps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'uuid', 'latitude', 'longitude', 'battery_charge', 'startdate', 'enddate', 'status', 'description', 'user_id', 'is_running', 'is_public', 'error_code'], 'required'],
            [['pests_network_id', 'user_id', 'is_running', 'is_public'], 'integer'],
            [['latitude', 'longitude', 'battery_charge'], 'number'],
            [['startdate', 'enddate', 'created_at', 'updated_at'], 'safe'],
            [['status', 'description'], 'string'],
            [['name', 'uuid'], 'string', 'max' => 255],
            [['error_code'], 'string', 'max' => 50]
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
            'pests_network_id' => 'Pests Network ID',
            'uuid' => 'Uuid',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'battery_charge' => 'Battery Charge',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'status' => 'Status',
            'description' => 'Description',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'is_running' => 'Is Running',
            'is_public' => 'Is Public',
            'error_code' => 'Error Code',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPestReports()
    {
        return $this->hasMany(PestReports::className(), ['trap_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPestsNetwork()
    {
        return $this->hasOne(TrapNetworks::className(), ['id' => 'pests_network_id']);
    }

    /**
     * @inheritdoc
     * @return TrapsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrapsQuery(get_called_class());
    }
}
