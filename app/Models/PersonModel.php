<?php
namespace App\Models;

class PersonModel extends BaseModel
{
    /**
     * 个人资料表 model
     */

    protected $table = 'user_persons';
    protected $fillable = [
        'id','realname','sex','idcard','idfront','uid','created_at','updated_at',
    ];
    protected $sexs = [
        1=>'男','女',
    ];

    public function sexName()
    {
        return $this->sexs[$this->sex];
    }
}