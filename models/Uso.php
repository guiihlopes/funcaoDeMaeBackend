<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uso".
 *
 * @property integer $idUso
 * @property integer $tempoUso
 * @property string $dtUso
 * @property double $consumoMedio
 * @property integer $idTag
 * @property string $idDispositivo
 *
 * @property Tag $idTag0
 * @property Dispositivo $idDispositivo0
 */
class Uso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tempoUso', 'dtUso', 'consumoMedio', 'idTag', 'idDispositivo'], 'required'],
            [['tempoUso', 'idTag'], 'integer'],
            [['dtUso'], 'safe'],
            [['consumoMedio'], 'number'],
            [['idDispositivo'], 'string'],
            [['idTag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['idTag' => 'idTag']],
            [['idDispositivo'], 'exist', 'skipOnError' => true, 'targetClass' => Dispositivo::className(), 'targetAttribute' => ['idDispositivo' => 'idDispositivo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUso' => 'Id Uso',
            'tempoUso' => 'Tempo de uso',
            'dtUso' => 'Data de uso',
            'consumoMedio' => 'Consumo médio',
            'idTag' => 'Tag',
            'idDispositivo' => 'Id Dispositivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['idTag' => 'idTag']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivo()
    {
        return $this->hasOne(Dispositivo::className(), ['idDispositivo' => 'idDispositivo']);
    }
}
