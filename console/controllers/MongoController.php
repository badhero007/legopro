<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/4
 * Time: 14:42
 */
namespace console\controllers;

use common\core\Llog;
use lego\base\Legomongo;
use yii\console\Controller;

class MongoController extends Controller {
    public function actionMongotest(){
        $m = Legomongo::getInstance();
        $db = $m->selectDB('dianping');
        $collection = $db->selectCollection('shops');
        $cursor=$collection->find()->limit(10);
        $data = [];
        foreach ($cursor as $id => $value) {
            $data[]=$value;
        }
        print_r($data);
    }

    public function actionBigcate(){
        $bigcates = DianpingBeijing::find()->where('is_closed=0 and latitude is not null and longitude is not null')->groupBy('big_cate_id')->asArray()->all();
        foreach($bigcates as $key => $val){
            $bigcate = new BigCate();
            $bigcate->big_cate_id = $val['big_cate_id'];
            $bigcate->big_cate_name = $val['big_cate'];
            if(!$bigcate->save()){
                var_dump($bigcate->getErrors());
            }

            echo $key.',';
        }
    }

    public function actionSmallcate(){
        $bigcates = DianpingBeijing::find()->where('is_closed=0 and latitude is not null and longitude is not null')->groupBy('small_cate_id')->asArray()->all();
        foreach($bigcates as $key => $val){
            $smallcate = new SmallCate();
            $smallcate->big_cate_name = $val['big_cate'];
            $smallcate->big_cate_id = $val['big_cate_id'];
            $smallcate->small_cate_name = $val['small_cate'];
            $smallcate->small_cate_id = $val['small_cate_id'];

            if(!$smallcate->save()){
                var_dump($smallcate->getErrors());
            }

            echo $key.',';
        }
    }


    public function actionDianpingdata(){
        try{
            $i = 0;
            $count = 1;
            $limit = 3000;

            $m = JMongo::getInstance();
            $db = $m->selectDB('dianping');
            $collection = $db->selectCollection('shops');

            while($count > 0){
                $condition = 'is_closed=0 and latitude is not null and longitude is not null';

                $query = DianpingBeijing::find();
                $query->where($condition)->asArray();
                $query->limit($limit)->offset($i*$limit);
                Llog::log($query->createCommand()->rawSql,'mongo/insertdata');
                $count = $query->count();
                $shops = $query->all();
                $i++;
                $rows = [];
                foreach($shops as $key => $val){
                    if($val['longitude'] == 360 || $val['latitude'] == 360 ){
                        continue;
                    }
                    $val['position'] = [
                        'type'=>'Point',
                        'coordinates'=>[
                            floatval($val['longitude']),
                            floatval($val['latitude'])
                        ]
                    ];
                    $rows[]=$val;
                }
                $collection->batchInsert($rows);
                echo $i.',';
            }
        } catch(\Exception $e){
            Llog::log($e->getMessage().'|'.$e->getTraceAsString(),'mongo/insertdata');
        }
    }

    public function actionCreateindex(){
        $m = JMongo::getInstance();
        $db = $m->selectDB('dianping');
        $collection = $db->selectCollection('shops');
        $collection->ensureIndex(["position"=>"2dsphere"]);
    }

    public function actionShoplist(){
        $m = JMongo::getInstance();
        $db = $m->selectDB('dianping');
        $collection = $db->selectCollection('shops');
        $cid = 10304;
        $community = \louli\modlib\BaseCommunityLib::getInstance()->getById($cid);
        $longitude = $community['longitude'];
        $latitude = $community['latitude'];

        //百度坐标转换为GCJ-02坐标
        $gcj = Helper::baiduToGCJ($latitude,$longitude);
        $param = [
            'position' => [
                '$nearSphere' => [
                    '$geometry' => [
                        'type' => 'Point',
                        'coordinates' => [floatval($gcj['lng']), floatval($gcj['lat'])],
                    ],
                    '$maxDistance' => 200000,
                    '$uniqueDocs' => 1
                ]
            ],
            'phone' => [
                '$ne' => '无'
            ],
            'small_cate_id' => 'g135'
        ];
        $shops = $collection->find($param)->limit(100);


        $nearshops = [];
        foreach ($shops as $id => $value) {
            $vgcj = Helper::baiduToGCJ($value['latitude'],$value['longitude']);
            $value['distance'] = Helper::getDistance($gcj['lng'],$gcj['lat'],$vgcj['lng'],$vgcj['lat'],1,2);
            $nearshops[]=$value;
        }
        print_r(Helper::newArraySort($nearshops,'distance','SORT_ASC'));
    }
} 