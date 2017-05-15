<?php
namespace App\Models\Wallet;

use App\Models\BaseModel;

class TipModel extends BaseModel
{
    /**
     * 这是用户红包表
     * 主要用于活动、节日等给用户的福利
     */

    protected $table = 'ac_tip';
    protected $fillable = [
        'id','uid','type','tip','created_at','updated_at',
    ];
    protected $types = [
        1=>'新人红包',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getTypeName()
    {
        return array_key_exists($this->type,$this->types) ? $this->types[$this->type] : '';
    }
}