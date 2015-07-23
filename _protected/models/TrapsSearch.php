<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Traps;

/**
 * TrapsSearch represents the model behind the search form about `app\models\Traps`.
 */
class TrapsSearch extends Traps
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pests_network_id', 'user_id', 'is_running', 'is_public'], 'integer'],
            [['name', 'uuid', 'startdate', 'enddate', 'status', 'description', 'created_at', 'error_code', 'updated_at'], 'safe'],
            [['latitude', 'longitude', 'battery_charge'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $user_id, $public = true)
    {
        $query = Traps::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($user_id)) {
            $query->orWhere(['user_id' => $user_id]);
        }

        if($public) {
            $query->orWhere(['is_public' => 1]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pests_network_id' => $this->pests_network_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'battery_charge' => $this->battery_charge,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'created_at' => $this->created_at,
            'is_running' => $this->is_running,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'error_code', $this->error_code]);
        return $dataProvider;
    }
}
