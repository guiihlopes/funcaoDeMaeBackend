<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Dispositivo".
 *
 * @property integer $id
 * @property string $apelido_dispositivo
 * @property string $creation_date
 * @property integer $limite_energia
 * @property integer $nivel_bat_dispositivo
 * @property string $serial
 * @property string $status_dispositivo
 * @property string $id_administrador
 *
 * @property Administrador $idAdministrador
 */
class Dispositivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Dispositivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apelido_dispositivo', 'serial', 'status_dispositivo'], 'string'],
            [['creation_date'], 'safe'],
            [['limite_energia', 'nivel_bat_dispositivo'], 'integer'],
            [['id_administrador'], 'number'],
            [['id_administrador'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['id_administrador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apelido_dispositivo' => 'Apelido Dispositivo',
            'creation_date' => 'Creation Date',
            'limite_energia' => 'Limite Energia',
            'nivel_bat_dispositivo' => 'Nivel Bat Dispositivo',
            'serial' => 'Serial',
            'status_dispositivo' => 'Status Dispositivo',
            'id_administrador' => 'Id Administrador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'id_administrador']);
    }
}
