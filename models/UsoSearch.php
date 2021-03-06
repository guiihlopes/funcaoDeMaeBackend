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
            'pagination' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(count($this->idDispositivo) == 0){
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idUso' => $this->idUso,
            'tempoUso' => $this->tempoUso,
            'consumoMedio' => $this->consumoMedio,
            'idTag' => $this->idTag,
        ]);

        $dtUso = preg_replace("/(\d{2})?\/?(\d{2})?\/?(\d{4})?/", "$3$2$1", $this->dtUso);
        
        $query->andFilterWhere(['like', 'dtUso', $dtUso])
            ->andFilterWhere([
                'uso.idDispositivo' => $this->idDispositivo,
            ])
            ->andFilterWhere([
                'dispositivo.idAdmin' => Yii::$app->user->identity->idAdmin,
            ])
            ->andFilterWhere([
                'dispositivo.idDispositivo' => $this->idDispositivo,
            ]);

        return $dataProvider;
    }
}
