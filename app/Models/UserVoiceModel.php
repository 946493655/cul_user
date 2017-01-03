<?php
namespace App\Models;

class UserVoiceModel extends BaseModel
{
    protected $table = 'bs_voices';
    protected $fillable = [
        'id','name','uid','work','intro','isshow','created_at',
    ];
    //isshow：0所有，1不显示，2前台列表显示
    protected $isshows = [
        '所有','不显示','显示',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getIsShow()
    {
        return $this->isshows[$this->isshow];
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