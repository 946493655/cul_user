<?php
namespace App\Models\Wallet;

use App\Models\BaseModel;

class ActivityUserModel extends BaseModel
{
    /**
     * 平台最新活动
     */

    protected $table = 'act_users';
    protected $fillable = [
        'id','act_id','uid','isuse','del','created_at','updated_at',
    ];

    /**
     * 是否已使用
     */
    protected $isuses = [
        '未使用','已使用',
    ];

    public function getActivityName()
    {
        $activity = ActivityModel::find($this->act_id);
        return $activity ? $activity->name : '';
    }

    public function getActivityPeriod()
    {
        $activity = ActivityModel::find($this->act_id);
        return $activity ? $activity->period() : '';
    }

    public function getActivityGenreName()
    {
        $activity = ActivityModel::find($this->act_id);
        return $activity ? $activity->getGenreName() : '';
    }

    public function getIsUse()
    {
        return array_key_exists($this->isuse,$this->isuses) ? $this->isuses[$this->isuse] : '';
    }
}