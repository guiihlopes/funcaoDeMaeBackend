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
 * @property integer $idAdm
 *
 * @property Administrador $idAdm0
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
            [['nivelBattDispositivo', 'limiteEnergia', 'idAdm'], 'integer'],
            [['idAdm'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['idAdm' => 'idAdmin']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDispositivo' => 'Id Dispositivo',
            'apelidoDispositivo' => 'Dispositivo',
            'nivelBattDispositivo' => 'Nivel de bateria do dispositivo',
            'limiteEnergia' => 'Limite de energia',
            'idAdm' => 'Id Adm',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['idAdmin' => 'idAdm']);
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
}
