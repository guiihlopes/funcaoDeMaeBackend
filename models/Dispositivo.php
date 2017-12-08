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

    public function scenarios(){
        $scenarios = parent::scenarios();

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDispositivo', 'apelidoDispositivo'], 'required'],
            [['idDispositivo', 'apelidoDispositivo'], 'string'],
            [['idDispositivo'], 'default', 'value'=> Yii::$app->user->identity->idAdmin],
            ['idDispositivo', 'isValidDispositivo', 'on' => 'register'],
            [['nivelBattDispositivo', 'limiteEnergia', 'idAdmin'], 'integer'],
        ];
    }

    public function isValidDispositivo($attribute, $params)
    {
        $dispositivo = $this::find()->where(['idDispositivo' => $this->idDispositivo])->andWhere(['idAdmin' => null])->all();

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
            'idDispositivo' => 'Serial do dispositivo',
            'apelidoDispositivo' => 'Apelido Dispositivo',
            'nivelBattDispositivo' => 'Nivel de bateria Dispositivo',
            'limiteEnergia' => 'Limite de Energia',
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

    public function getAdministradorDispositivos() {
        return $this->find()->where(['idAdmin' => Yii::$app->user->identity->idAdmin])->all();
    }
}
