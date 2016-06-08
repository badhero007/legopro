<?php

namespace common\models\dianping;

use Yii;

/**
 * This is the model class for table "big_cate".
 *
 * @property integer $id
 * @property integer $big_cate_id
 * @property string $big_cate_name
 */
class BigCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'big_cate';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dianping');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['big_cate_id'], 'integer'],
            [['big_cate_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'big_cate_id' => 'Big Cate ID',
            'big_cate_name' => 'Big Cate Name',
        ];
    }
}
