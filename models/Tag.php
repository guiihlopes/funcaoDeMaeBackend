<?php

namespace app\models;

use Yii;

use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;

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
        $oldTagDispositivos = $this->tagDispositivos;
        $oldIdDispositivos = ArrayHelper::getColumn($oldTagDispositivos, 'idDispositivo');
        $dispositivosIdRemovidos = array_diff($oldIdDispositivos, $this->dispositivos);
        $dispositivosIdAdicionados = array_diff($this->dispositivos, $oldIdDispositivos);
        foreach ($dispositivosIdAdicionados as $key => $value){
            $dispositivo = Dispositivo::findOne($value);
            $this->prepareAndSendMessage($dispositivo->idHub, $dispositivo->limiteEnergia, $this->idTag);
        }
        foreach ($dispositivosIdRemovidos as $key => $value){
            $dispositivo = Dispositivo::findOne($value);
            $this->prepareAndSendMessage($dispositivo->idHub, $dispositivo->limiteEnergia, "", $this->idTag);
        }
        if(count($this->dispositivos)){
            TagDispositivo::deleteAll(['idTag' => $this->idTag]);
            foreach($this->dispositivos as $key => $value){
                $tagDispositivo = new TagDispositivo();
                $tagDispositivo->idDispositivo = $value;
                $tagDispositivo->idTag = $this->idTag;
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
                $message = [
                    'limiteEnergia' => $dispositivo->limiteEnergia,
                    'tagInserida' => "",
                    'tagExcluida' => $this->idTag,
                ];
                $connectionString = 'HostName=FuncaoDeMae.azure-devices.net;SharedAccessKeyName=iothubowner;SharedAccessKey=1cxMyEjEooVS63wrJOW9e/IPx7oq+2IQF2gN1nH/tWE=';
                $data = [
                    'connectionString' => $connectionString,
                    'targetDevice' => $deviceId,
                    'message' => $message,
                ];
                $this->sendMessage($data);
            }
        }

        return parent::beforeSave($insert);
    }

    public function prepareAndSendMessage($deviceId, $limiteEnergia = "", $tagInserida = "", $tagExcluida = ""){
        $message = [
            'limiteEnergia' => $limiteEnergia,
            'tagInserida' => $tagInserida,
            'tagExcluida' => $tagExcluida,
        ];
        $connectionString = 'HostName=FuncaoDeMae.azure-devices.net;SharedAccessKeyName=iothubowner;SharedAccessKey=1cxMyEjEooVS63wrJOW9e/IPx7oq+2IQF2gN1nH/tWE=';
        $data = [
            'connectionString' => $connectionString,
            'targetDevice' => $deviceId,
            'message' => $message,
        ];
        $this->sendMessage($data);
    }

    private function sendMessage($data){
        $host = 'localhost:8090';
        $uri = '/api/tags';
        $client = new Client([
            'base_uri' => 'http://' . $host
        ]);

        $response = $client->request('POST', $uri, [
            'form_params' => $data,
        ]);

        return $response;
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
