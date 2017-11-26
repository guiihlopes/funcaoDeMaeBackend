<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Uso".
 *
 * @property string $id
 * @property string $consumeMedio
 * @property string $dtUso
 * @property string $idDispositivo
 * @property string $tempoUso
 * @property string $idTag
 */
class Uso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Uso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'consumeMedio', 'tempoUso', 'idTag'], 'number'],
            [['dtUso'], 'safe'],
            [['idDispositivo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'consumeMedio' => 'Consume Medio',
            'dtUso' => 'Dt Uso',
            'idDispositivo' => 'Id Dispositivo',
            'tempoUso' => 'Tempo Uso',
            'idTag' => 'Id Tag',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'idTag']);
    }
    public function getDispositivo()
    {
        return $this->hasOne(Dispositivo::className(), ['id' => 'idDispositivo']);
    }
}
