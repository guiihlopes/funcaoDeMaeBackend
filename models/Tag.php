<?php

namespace app\models;

use Yii;

use yii\helpers\ArrayHelper;
use AzureIoTHub\DeviceClient;

/**
 * This is the model class for table "tag".
 *
 * @property integer $idIndexTag
 * @property integer $idTag
 * @property string $apelidoTag
 * @property integer $limMaxTempoUso
 * @property integer $qtdeUsoDia
 * @property integer $idAdmin
 *
 * @property TagDispositivo[] $tagDispositivos
 * @property Uso[] $usos
 */
class Tag extends \yii\db\ActiveRecord
{
    public $dispositivos;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    public function scenarios(){
        $scenarios = parent::scenarios();

        $scenarios['register'] = ['idTag', 'dispositivos', 'apelidoTag', 'limMaxTempoUso', 'qtdeUsoDia'];
        $scenarios['delete'] = [];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTag', 'apelidoTag', 'dispositivos'], 'required'],
            [['dispositivos'], 'safe', 'on' => 'register'],
            [['idTag', 'limMaxTempoUso', 'qtdeUsoDia', 'idAdmin'], 'integer'],
            [['qtdeUsoDia'], 'integer', 'min' => 1, 'max' => 5],
            ['idTag', 'isValidTag', 'on' => 'register'],
            [['apelidoTag'], 'string'],
        ];
    }

    public function beforeSave($insert){
        $oldAttributes = $this->oldAttributes;
        if($oldAttributes['limMaxTempoUso'] != $this->limMaxTempoUso){
            $this->limMaxTempoUso = $this->limMaxTempoUso*60;
        }
        if(count($this->dispositivos)){
            TagDispositivo::deleteAll(['idTag' => $this->idTag]);
            foreach($this->dispositivos as $key => $value){
                $tagDispositivo = new TagDispositivo();
                $tagDispositivo->idDispositivo = $value;
                $tagDispositivo->idTag = $this->idTag;
                $host = 'FuncaoDeMae.azure-devices.net';
                $dispositivo = $tagDispositivo->dispositivo;
                $deviceId = $dispositivo->idHub;
                $deviceKey = $value;
                $client = new DeviceClient($host, $deviceId, $deviceKey);
                $response = $client->sendEvent([
                    'limiteEnergia' => $dispositivo->limiteEnergia,
                    'tagInserida' => $this->idTag,
                    'tagExcluida' => "",
                ]);
                if($tagDispositivo->validate()){
                    $tagDispositivo->save();
                }
            }
        }
        // delete
        if($this->idAdmin == ''){
            foreach($this->tagDispositivos as $key => $value){
                $host = 'FuncaoDeMae.azure-devices.net';
                $dispositivo = $value->dispositivo;
                $deviceId = $dispositivo->idHub;
                $deviceKey = $dispositivo->idDispositivo;
                $client = new DeviceClient($host, $deviceId, $deviceKey);
                $response = $client->sendEvent([
                    'limiteEnergia' => $dispositivo->limiteEnergia,
                    'tagInserida' => "",
                    'tagExcluida' => $this->idTag,
                ]);
            }
        }

        return parent::beforeSave($insert);
    }

    public function isValidTag($attribute, $params)
    {
        $tag = $this::find()->where(['idTag' => $this->idTag])->andWhere(['idAdmin' => null])->all();

        if (!$tag) {
            $this->addError($attribute, 'Tag inválida ou já utilizada previamente!');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIndexTag' => 'Id Index Tag',
            'idTag' => 'Número da tag',
            'apelidoTag' => 'Apelido da tag',
            'limMaxTempoUso' => 'Máximo tempo uso (min)',
            'qtdeUsoDia' => 'Quantidade de uso por dia',
            'idAdmin' => 'Id Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagDispositivos()
    {
        return $this->hasMany(TagDispositivo::className(), ['idTag' => 'idTag']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsos()
    {
        return $this->hasMany(Uso::className(), ['idTag' => 'idTag']);
    }
    
    public function getAdministrador()
    {
        return $this->hasOne(Administrador::className(), ['idAdmin' => 'idAdmin']);
    }
}
