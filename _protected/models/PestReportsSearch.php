<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PestReports;

/**
 * PestReportsSearch represents the model behind the search form about `app\models\PestReports`.
 */
class PestReportsSearch extends PestReports
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num_of_pests', 'num_of_pests_total', 'trap_id', 'is_reset', 'pest_family'], 'integer'],
            [['date_time', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params)
    {
        $query = PestReports::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'num_of_pests' => $this->num_of_pests,
            'num_of_pests_total' => $this->num_of_pests_total,
            'date_time' => $this->date_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'trap_id' => $this->trap_id,
            'is_reset' => $this->is_reset,
            'pest_family' => $this->pest_family,
        ]);

        return $dataProvider;
    }
}
