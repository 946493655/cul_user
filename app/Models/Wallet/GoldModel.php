<?php
namespace App\Models\Wallet;

use App\Models\BaseModel;

class GoldModel extends BaseModel
{
    /**
     * 这是用户金币表
     * 主要用于用户操作后的奖励
     */

    protected $table = 'user_gold';
    protected $fillable = [
        'id','uid','genre','gold','created_at','updated_at',
    ];
    //金币奖励：1建议发布奖励1-5，2建议好评奖励6-10，3心声发布奖励1-5，4主体业务发布奖励1-5，5订单申请奖励1-5，6订单好评奖励6-10
    protected $genres = [
        1=>'建议发布奖励','建议好评奖励','心声发布奖励','业务发布奖励','订单申请奖励','订单好评奖励',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->uid ? $this->getUserName($this->uid) : '';
    }

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }
}