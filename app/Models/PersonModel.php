<?php
namespace App\Models;

class PersonModel extends BaseModel
{
    /**
     * 个人资料表 model
     */

    protected $table = 'persons';
    protected $fillable = [
        'id','realname','sex','idcard','idfront','uid','created_at','updated_at',
    ];
}