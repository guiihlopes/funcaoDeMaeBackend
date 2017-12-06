<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dispositivo".
 *
 * @property string $idDispositivo
 * @property string $apelidoDispositivo
 * @property integer $nivelBattDispositivo
 * @property integer $limiteEnergia
 * @property integer $idAdmin
 *
 * @property TagDispositivo[] $tagDispositivos
 * @property Uso[] $usos
 */
class Dispositivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispositivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDispositivo', 'apelidoDispositivo'], 'required'],
            [['idDispositivo', 'apelidoDispositivo'], 'string'],
            ['idDispositivo', 'isValidDispositivo'],
            [['nivelBattDispositivo', 'limiteEnergia', 'idAdmin'], 'integer'],
        ];
    }

    public function isValidDispositivo($attribute, $params)
    {
        $dispositivo = $this::find($this->idDispositivo)->where(['idAdmin' => null])->all();


        if (!$dispositivo) {
            $this->addError($attribute, 'Serial inválido ou já utilizado previamente!');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDispositivo' => 'Id Dispositivo',
            'apelidoDispositivo' => 'Apelido Dispositivo',
            'nivelBattDispositivo' => 'Nivel Batt Dispositivo',
            'limiteEnergia' => 'Limite Energia',
            'idAdmin' => 'Id Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagDispositivos()
    {
        return $this->hasMany(TagDispositivo::className(), ['idDispositivo' => 'idDispositivo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsos()
    {
        return $this->hasMany(Uso::className(), ['idDispositivo' => 'idDispositivo']);
    }
     public function getAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['idAdmin' => 'idAdmin']);
    }
}
