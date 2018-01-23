<?php

namespace frontend\modules\test\logic;
use common\models\dianping\DianpingBeijing;

class DefaultLogic
{
    public function testLogic(){
        $model = new DianpingBeijing();
        $result = $model->findOne(['shop_id'=>107069]);
        var_dump($result);
    }
}