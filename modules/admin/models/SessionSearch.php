<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Session;

/**
 * SessionSearch represents the model behind the search form of `app\modules\admin\models\Session`.
 */
class SessionSearch extends Session
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'expire'], 'integer'],
            [['id', 'data', 'user_id', 'last_activity', 'last_ip'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Session::find()->groupBy('user_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'session_id' => $this->session_id,
            'expire' => $this->expire,
            'last_activity' => $this->last_activity,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'last_ip', $this->last_ip])
            ->andFilterWhere(['not', ['user_id' => null]])
            ->andFilterWhere(['not', ['user_id' => '']]);

        return $dataProvider;
    }
}
