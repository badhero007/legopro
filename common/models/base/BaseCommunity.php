<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "base_community".
 *
 * @property integer $id
 * @property integer $provincecode
 * @property integer $citycode
 * @property integer $countycode
 * @property integer $towncode
 * @property integer $villagecode
 * @property integer $code
 * @property integer $codenum
 * @property string $longitude
 * @property string $latitude
 * @property integer $radiuslimit
 * @property integer $level
 * @property integer $lifetype
 * @property string $lifecode
 * @property string $lifename
 * @property string $name
 * @property string $search
 * @property string $address
 * @property string $content
 * @property integer $ring
 * @property integer $status
 * @property integer $usercount
 * @property string $opentime
 * @property string $ctime
 * @property string $utime
 */
class BaseCommunity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'base_community';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('base');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincecode', 'citycode', 'countycode', 'towncode', 'villagecode', 'code', 'codenum', 'radiuslimit', 'level', 'lifetype', 'ring', 'status', 'usercount'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['opentime', 'ctime', 'utime'], 'safe'],
            [['lifecode'], 'string', 'max' => 9],
            [['lifename', 'name'], 'string', 'max' => 32],
            [['search', 'address', 'content'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provincecode' => 'Provincecode',
            'citycode' => 'Citycode',
            'countycode' => 'Countycode',
            'towncode' => 'Towncode',
            'villagecode' => 'Villagecode',
            'code' => 'Code',
            'codenum' => 'Codenum',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'radiuslimit' => 'Radiuslimit',
            'level' => 'Level',
            'lifetype' => 'Lifetype',
            'lifecode' => 'Lifecode',
            'lifename' => 'Lifename',
            'name' => 'Name',
            'search' => 'Search',
            'address' => 'Address',
            'content' => 'Content',
            'ring' => 'Ring',
            'status' => 'Status',
            'usercount' => 'Usercount',
            'opentime' => 'Opentime',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
