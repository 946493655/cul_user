<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class RoleActionModel extends BaseModel
{
    protected $table = 'role_action';
    protected $fillable = [
        'id','role_id','action_id','created_at','updated_at',
    ];
}