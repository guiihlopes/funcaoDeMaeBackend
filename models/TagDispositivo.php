<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag_dispositivo".
 *
 * @property integer $idTag
 * @property string $idDispositivo
 *
 * @property Tag $idTag0
 * @property Dispositivo $idDispositivo0
 */
class TagDispositivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_dispositivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTag', 'idDispositivo'], 'required'],
            [['idTag'], 'integer'],
            [['idDispositivo'], 'string'],
            [['idTag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['idTag' => 'idTag']],
            [['idDispositivo'], 'exist', 'skipOnError' => true, 'targetClass' => Dispositivo::className(), 'targetAttribute' => ['idDispositivo' => 'idDispositivo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTag' => 'Id Tag',
            'idDispositivo' => 'Id Dispositivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['idTag' => 'idTag']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivo()
    {
        return $this->hasOne(Dispositivo::className(), ['idDispositivo' => 'idDispositivo']);
    }
}
