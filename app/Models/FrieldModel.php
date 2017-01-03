<?php
namespace App\Models;

class FrieldModel extends BaseModel
{
    /**
     * 这是用户好友表
     */

    protected $table = 'bs_frield';
    protected $fillable = [
        'id','uid','frield_id','isauth','remarks','remarks2','del','created_at','authTime',
    ];

    protected $isauths = [
        1=>'好友申请','好友拒绝','好友同意',
    ];

    public function getAuthName()
    {
        return array_key_exists($this->isauth,$this->isauths) ? $this->isauths[$this->isauth] : '';
    }

    public function getUName()
    {
        return $this->getUser($this->uid) ? $this->getUser($this->uid)['username'] : '';
    }

    public function getFrieldName()
    {
        return $this->getUser($this->frield_id) ? $this->getUser($this->frield_id)['username'] : '';
    }

    public function authTime()
    {
        return date('Y年m月d日 H:i',$this->authTime);
    }

    /**
     * 用户头像 id
     */
    public function getHead($uid)
    {
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel->head : 0;
    }
}