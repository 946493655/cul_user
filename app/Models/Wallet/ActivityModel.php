<?php
namespace App\Models\Wallet;

use App\Models\BaseModel;

class ActivityModel extends BaseModel
{
    /**
     * 平台最新活动
     */

    protected $table = 'activity';
    protected $fillable = [
        'id','name','genre','thumb','link','intro','number','del','created_at','updated_at',
    ];

    /**
     * 活动类型：1免费周期，2公益专栏，3折扣不停，4套餐优惠，5分享返利，6消费返利，
     */
    protected $genres = [
        1=>'周期性免费','公益专栏','折扣不停','套餐优惠','分享返利','消费返利',
    ];

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }
}