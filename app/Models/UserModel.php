<?php
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 用户model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','pwd','ip','email','qq','tel','mobile','area','address','head','isauth','emailck','isuser','isvip','limit','created_at','updated_at','lastLogin',
    ];
}