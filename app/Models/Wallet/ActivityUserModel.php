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
        'id','act_id','uid','del','created_at','updated_at',
    ];

    public function getActivityName()
    {
        $activity = ActivityModel::find($this->act_id);
        return $activity ? $activity->name : '';
    }
}