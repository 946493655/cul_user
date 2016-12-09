<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class LogModel extends BaseModel
{
    /**
     * 这是管理员日志表
     */

    protected $table = 'ba_log';
    protected $fillable = [
        'id','uid','uname','genre','action','serial','ip','ipaddress','loginTime','logoutTime',
    ];
    protected $genres = [
        1=>'用户记录','管理员记录',
    ];

    public function loginTime()
    {
        return $this->loginTime ? date("Y年m月d日 H:i", $this->loginTime) : '';
    }

    public function logoutTime()
    {
        return $this->logoutTime ? date("Y年m月d日 H:i", $this->logoutTime) : '非正常退出';
    }

    /**
     * 管理员信息
     */
    public function getAdmin($uid=null)
    {
        $adminInfo = AdminModel::find($uid);
        return $adminInfo ? $adminInfo : '';
    }

    /**
     * 管理员名称
     */
    public function getAdminName($uid=null)
    {
        return $this->getAdmin($uid) ? $this->getAdmin($uid)->username : '';
    }

    /**
     * 日志用户名
     */
    public function getUname()
    {
        $uid = $this->uid;
        if ($this->genre==1) {
            $uname = $this->getUserName($uid);
        } elseif ($this->genre==2) {
            $uname = $this->getAdminName($uid);
        }
        return isset($uname) ? $uname : '';
    }

    /**
     * 日志类型
     */
    public function getGenreName()
    {
        return $this->genres[$this->genre];
    }
}