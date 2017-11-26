<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tag".
 *
 * @property string $id
 * @property integer $limMaxTempoUso
 * @property string $apelidoTag
 * @property integer $qtdeUsoDia
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'number'],
            [['limMaxTempoUso', 'qtdeUsoDia'], 'integer'],
            [['apelidoTag'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'limMaxTempoUso' => 'Lim Max Tempo Uso',
            'apelidoTag' => 'Apelido Tag',
            'qtdeUsoDia' => 'Qtde Uso Dia',
        ];
    }
}
