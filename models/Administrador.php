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
    public $idDispositivo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrador';
    }

    public function scenarios(){
        $scenarios = parent::scenarios();

        $scenarios['register'] = ['idDispositivo', 'email', 'senha', 'nome', 'cpf', 'dtNasc', 'cep', 'logradouro', 'numero', 'bairro', 'cidade', 'estado', 'telefone'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'senha', 'nome', 'cpf', 'dtNasc', 'cep', 'logradouro', 'numero', 'bairro', 'cidade', 'estado', 'telefone'], 'required'],
            [['email'], 'email'],
            [['idDispositivo'], 'required', 'on' => 'register'],
            ['idDispositivo', 'isValidDispositivo', 'on' => 'register'],
            [['email', 'senha', 'nome', 'cpf', 'dtNasc', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'telefone'], 'string'],
        ];
    }

    public function isValidDispositivo($attribute, $params)
    {
        $dispositivo = Dispositivo::find()->where(['idDispositivo' => $this->idDispositivo])->andWhere(['idAdmin' => null])->all();

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
            'idDispositivo' => 'Serial do dispositivo',
        ];
    }
}
