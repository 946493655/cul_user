<?php
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 用户model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','pwd','ip','email','qq','tel','mobile','area','address','head','isauth','emailck','isuser','isvip','created_at','updated_at','lastLogin',
    ];

    //用户认证：1未认证1 ，2认证失败，2认证成功
    protected $isauths = [
        1=>'未认证','认证失败','认证成功',
    ];

    /**
     * isuser：
     * 1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，设计公司，配音公司，广告商，50超级用户
     */
    protected $isusers = [
        1=>'普通用户','个人会员','企业会员','设计师','广告公司','影视公司','租赁公司','设计公司','配音公司','广告商',
        50=>'超级用户',
    ];
    
    protected $isvips = [
        '非VIP','VIP会员',
    ];

    public function authType()
    {
        return $this->isauths[$this->isauth];
    }

    public function userType()
    {
        return $this->isusers[$this->isuser];
    }

    public function isvip()
    {
        return $this->isvips[$this->isvip];
    }
}