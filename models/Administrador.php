<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property integer $idAdmin
 * @property string $email
 * @property string $senha
 * @property string $nome
 * @property string $cpf
 * @property string $dtNasc
 * @property string $cep
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $telefone
 *
 * @property Dispositivo[] $dispositivos
 * @property Tag[] $tags
 */
class Administrador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'senha', 'nome', 'cpf', 'dtNasc', 'cep', 'logradouro', 'numero', 'bairro', 'cidade', 'estado', 'telefone'], 'required'],
            [['email', 'senha', 'nome', 'cpf', 'dtNasc', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'telefone'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAdmin' => 'Id Admin',
            'email' => 'Email',
            'senha' => 'Senha',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'dtNasc' => 'Dt Nasc',
            'cep' => 'Cep',
            'logradouro' => 'Logradouro',
            'numero' => 'Numero',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'telefone' => 'Telefone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivo::className(), ['idAdm' => 'idAdmin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['idAdm' => 'idAdmin']);
    }
}
