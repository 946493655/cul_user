<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * 基础 model
     */

    public $timestamps = false;

    //isshow：1不显示，2前台列表显示
    protected $isshows = [
        1=>'不显示','显示',
    ];

    public function getIsShow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 由uid得到 用户信息
     */
    public function getUser($uid=null)
    {
        $userInfo = UserModel::find($uid);
        return $userInfo ? $userInfo : '';
    }

    public function getUserName($uid=null)
    {
        return $this->getUser($uid) ? $this->getUser($uid)->username : '';
    }

    /**
     * 创建时间转换
     */
    public function createTime()
    {
        return $this->created_at ? date("Y年m月d日 H:i", $this->created_at) : '';
    }

    /**
     * 更新时间转换
     */
    public function updateTime()
    {
        return $this->updated_at ? date("Y年m月d日 H:i", $this->updated_at) : '未更新';
    }
}