<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 16/6/8
 * Time: 16:32
 */

namespace common\core;


class Helper {

    public static $instance;
    public static function getInstance()
    {
        if(empty(self::$instance)) self::$instance = new self();
        return self::$instance;
    }

    /**
     * 百度坐标转换为GCJ-02坐标
     * @param $lat 百度坐标纬度
     * @param $lng 百度坐标经度
     * @return array GCJ-02经纬度
     */
    public function baiduToGCJ($lat, $lng){
        $v = M_PI * 3000.0 / 180.0;
        $x = $lng - 0.0065;
        $y = $lat - 0.006;

        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $v);
        $t = atan2($y, $x) - 0.000003 * cos($x * $v);

        return array(
            'lat' => $z * sin($t),
            'lng' => $z * cos($t)
        );
    }

    /**
     * 计算两点地理坐标之间的距离
     * @param Decimal $longitude1 起点经度
     * @param Decimal $latitude1 起点纬度
     * @param Decimal $longitude2 终点经度
     * @param Decimal $latitude2 终点纬度
     * @param Int   $unit    单位 1:米 2:公里
     * @param Int   $decimal  精度 保留小数位数
     * @return Decimal
     */
    public function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI /180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if($unit==2){
            $distance = $distance / 1000;
        }

        return round($distance, $decimal);

    }

    public function arraySort($array,$field,$sortby = 'SORT_DESC'){
        $sort = array(
            'direction' => $sortby, //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => $field,       //排序字段
        );
        $arrSort = array();
        foreach($array AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }

        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
        }

        return $array;
    }
} 