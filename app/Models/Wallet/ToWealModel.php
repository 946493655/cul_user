<?php
namespace App\Models\Wallet;

use App\Models\BaseModel;

class ToWealModel extends BaseModel
{
    /**
     * 福利的兑换记录
     */

    protected $table = 'user_toweal';
    protected $fillable = [
        'id','uid','genre','val','created_at',
    ];

    //兑换类型：1签到兑换福利，2金币兑换福利，3红包兑换福利
    protected $genres = [
        1=>'签到兑换的','金币兑换的','红包兑换的',
    ];

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }
}