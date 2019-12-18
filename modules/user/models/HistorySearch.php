<?php

namespace app\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\History;

/**
 * HistorySearch represents the model behind the search form of `app\modules\admin\models\History`.
 */
class HistorySearch extends History
{
	public $test_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'test_id', 'user_id'], 'integer'],
            [['balls'], 'number'],
            [['created_at'], 'safe'],
            [['test_name'], 'string'],
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
        $query = History::find()->joinWith('test')->where(['user_id' => \Yii::$app->user->identity->getId()]);

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
            'id' => $this->id,
            'test_id' => $this->test_id,
            'user_id' => $this->user_id,
            'balls' => $this->balls,
            'created_at' => $this->created_at,
        ])->andFilterWhere(['like', 'test.name', $this->test_name]);

        return $dataProvider;
    }
}
