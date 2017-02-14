<?php
namespace App\Models;

class UserVoiceModel extends BaseModel
{
    protected $table = 'user_voice';
    protected $fillable = [
        'id','name','uid','work','intro','isshow','created_at',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    /**
     * 用户类型
     */
    public function getGenreName()
    {
        $userModel = UserModel::find($this->uid);
        return $userModel ? $userModel->userType() : '';
    }
}