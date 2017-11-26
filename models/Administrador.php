<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Administrador".
 *
 * @property string $id
 * @property string $bairro
 * @property string $cep
 * @property string $cidade
 * @property string $complemento
 * @property string $cpf
 * @property string $dt_nasc
 * @property string $email
 * @property string $estado
 * @property string $logradouro
 * @property string $nome
 * @property string $numero
 * @property string $senha
 * @property string $telefone
 *
 * @property Dispositivo[] $dispositivos
 */
class Administrador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Administrador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bairro', 'cep', 'cidade', 'complemento', 'cpf', 'dt_nasc', 'email', 'estado', 'logradouro', 'nome', 'numero', 'senha', 'telefone'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bairro' => 'Bairro',
            'cep' => 'Cep',
            'cidade' => 'Cidade',
            'complemento' => 'Complemento',
            'cpf' => 'Cpf',
            'dt_nasc' => 'Dt Nasc',
            'email' => 'Email',
            'estado' => 'Estado',
            'logradouro' => 'Logradouro',
            'nome' => 'Nome',
            'numero' => 'Numero',
            'senha' => 'Senha',
            'telefone' => 'Telefone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivo::className(), ['id_administrador' => 'id']);
    }
}
