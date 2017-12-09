<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Uso;

/**
 * UsoSearch represents the model behind the search form about `app\models\Uso`.
 */
class UsoSearch extends Uso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUso', 'tempoUso', 'idTag'], 'integer'],
            [['dtUso', 'idDispositivo'], 'safe'],
            [['consumoMedio'], 'number'],
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
        $query = Uso::find();

        $query->joinWith(['dispositivo', 'tag']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if ( !($this->load($params) && $this->validate()) or
            (empty($this->search_param1) and empty($this->search_param2) and empty($this->search_param3)) ) {
            $query->where('0=1');
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idUso' => $this->idUso,
            'tempoUso' => $this->tempoUso,
            'consumoMedio' => $this->consumoMedio,
            'idTag' => $this->idTag,
        ]);

        $query->andFilterWhere(['like', 'dtUso', $this->dtUso])
            ->andFilterWhere([
                'uso.idDispositivo' => $this->idDispositivo,
                'dispositivo.idDispositivo' => $this->idDispositivo,
            ]);

        return $dataProvider;
    }
}
