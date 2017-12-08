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
            [['email'], 'email'],
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
            'cpf' => 'CPF',
            'dtNasc' => 'Data de nascimento',
            'cep' => 'CEP',
            'logradouro' => 'Endereço',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'telefone' => 'Telefone',
        ];
    }
}
