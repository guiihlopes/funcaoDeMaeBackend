<?php

namespace app\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTag', 'apelidoTag', 'idAdmin'], 'required'],
            [['idTag', 'limMaxTempoUso', 'qtdeUsoDia', 'idAdmin'], 'integer'],
            [['apelidoTag'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIndexTag' => 'Id Index Tag',
            'idTag' => 'Id Tag',
            'apelidoTag' => 'Apelido Tag',
            'limMaxTempoUso' => 'Lim Max Tempo Uso',
            'qtdeUsoDia' => 'Qtde Uso Dia',
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
