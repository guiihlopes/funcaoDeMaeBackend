<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dispositivo;

/**
 * DispositivoSearch represents the model behind the search form about `app\models\Dispositivo`.
 */
class DispositivoSearch extends Dispositivo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDispositivo', 'apelidoDispositivo'], 'safe'],
            [['nivelBattDispositivo', 'limiteEnergia', 'idAdmin'], 'integer'],
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
        $query = Dispositivo::find();

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
            'nivelBattDispositivo' => $this->nivelBattDispositivo,
            'limiteEnergia' => $this->limiteEnergia,
            'idAdmin' => $this->idAdmin,
        ]);

        $query->andFilterWhere(['like', 'idDispositivo', $this->idDispositivo])
            ->andFilterWhere(['like', 'apelidoDispositivo', $this->apelidoDispositivo]);

        return $dataProvider;
    }
}
