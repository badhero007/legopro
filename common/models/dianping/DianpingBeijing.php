<?php

namespace common\models\dianping;

use Yii;

/**
 * This is the model class for table "dianping_beijing".
 *
 * @property integer $shop_id
 * @property integer $mall_id
 * @property integer $verified
 * @property integer $is_closed
 * @property string $name
 * @property string $alias
 * @property string $province
 * @property string $city
 * @property string $city_pinyin
 * @property integer $city_id
 * @property string $area
 * @property string $big_cate
 * @property string $big_cate_id
 * @property string $small_cate
 * @property string $small_cate_id
 * @property string $address
 * @property string $business_area
 * @property string $phone
 * @property string $hours
 * @property string $avg_price
 * @property string $stars
 * @property string $photos
 * @property string $description
 * @property string $tags
 * @property integer $map_type
 * @property string $latitude
 * @property string $longitude
 * @property string $navigation
 * @property string $traffic
 * @property string $parking
 * @property string $characteristics
 * @property string $product_rating
 * @property string $environment_rating
 * @property string $service_rating
 * @property integer $all_remarks
 * @property integer $very_good_remarks
 * @property integer $good_remarks
 * @property integer $common_remarks
 * @property integer $bad_remarks
 * @property integer $very_bad_remarks
 * @property string $recommended_dishes
 * @property string $recommended_products
 * @property string $nearby_shops
 * @property integer $is_chains
 * @property integer $take_away
 * @property string $group
 * @property string $card
 * @property string $latest_comment_date
 */
class DianpingBeijing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dianping_beijing';
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
            [['shop_id'], 'required'],
            [['shop_id', 'mall_id', 'verified', 'is_closed', 'city_id', 'map_type', 'all_remarks', 'very_good_remarks', 'good_remarks', 'common_remarks', 'bad_remarks', 'very_bad_remarks', 'is_chains', 'take_away'], 'integer'],
            [['hours', 'photos', 'description', 'tags', 'navigation', 'traffic', 'parking', 'characteristics', 'recommended_dishes', 'recommended_products', 'nearby_shops', 'group', 'card'], 'string'],
            [['avg_price', 'stars', 'latitude', 'longitude', 'product_rating', 'environment_rating', 'service_rating'], 'number'],
            [['name', 'alias', 'address', 'business_area', 'latest_comment_date'], 'string', 'max' => 255],
            [['province', 'city', 'city_pinyin', 'area', 'big_cate', 'big_cate_id', 'small_cate', 'small_cate_id', 'phone'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shop_id' => 'Shop ID',
            'mall_id' => 'Mall ID',
            'verified' => 'Verified',
            'is_closed' => 'Is Closed',
            'name' => 'Name',
            'alias' => 'Alias',
            'province' => 'Province',
            'city' => 'City',
            'city_pinyin' => 'City Pinyin',
            'city_id' => 'City ID',
            'area' => 'Area',
            'big_cate' => 'Big Cate',
            'big_cate_id' => 'Big Cate ID',
            'small_cate' => 'Small Cate',
            'small_cate_id' => 'Small Cate ID',
            'address' => 'Address',
            'business_area' => 'Business Area',
            'phone' => 'Phone',
            'hours' => 'Hours',
            'avg_price' => 'Avg Price',
            'stars' => 'Stars',
            'photos' => 'Photos',
            'description' => 'Description',
            'tags' => 'Tags',
            'map_type' => 'Map Type',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'navigation' => 'Navigation',
            'traffic' => 'Traffic',
            'parking' => 'Parking',
            'characteristics' => 'Characteristics',
            'product_rating' => 'Product Rating',
            'environment_rating' => 'Environment Rating',
            'service_rating' => 'Service Rating',
            'all_remarks' => 'All Remarks',
            'very_good_remarks' => 'Very Good Remarks',
            'good_remarks' => 'Good Remarks',
            'common_remarks' => 'Common Remarks',
            'bad_remarks' => 'Bad Remarks',
            'very_bad_remarks' => 'Very Bad Remarks',
            'recommended_dishes' => 'Recommended Dishes',
            'recommended_products' => 'Recommended Products',
            'nearby_shops' => 'Nearby Shops',
            'is_chains' => 'Is Chains',
            'take_away' => 'Take Away',
            'group' => 'Group',
            'card' => 'Card',
            'latest_comment_date' => 'Latest Comment Date',
        ];
    }
}
