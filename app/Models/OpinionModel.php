<?php
namespace App\Models;

class OpinionModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_opinions';
    protected $fillable = [
        'id','name','intro','uid','status','remarks','isshow','created_at','updated_at',
    ];
    protected $statuss = [
        '所有','新意见','处理中','不满意','满意',
    ];
    protected $isshows = [
        1=>'不显示','心声',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getStatusName()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
    }

    public function getIsShow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }
}