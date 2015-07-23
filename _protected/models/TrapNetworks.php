<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trap_networks".
 *
 * @property string $id
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property integer $campaign_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 *
 * @property Users $user
 * @property Traps[] $traps
 */
class TrapNetworks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trap_networks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'subtitle', 'description', 'campaign_id', 'user_id'], 'required'],
            [['description'], 'string'],
            [['campaign_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'subtitle'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'campaign_id' => 'Campaign ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraps()
    {
        return $this->hasMany(Traps::className(), ['pests_network_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TrapNetworksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrapNetworksQuery(get_called_class());
    }
}
