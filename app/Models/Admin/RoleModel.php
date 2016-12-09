<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class RoleModel extends BaseModel
{
    protected $table = 'ba_role';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];

//    public function admin()
//    {
//        return AdminModel::where('role_id',$this->id)->get();
//    }

    /**
     * 获取操作
     */
    public function getActions($role=null)
    {
        if ($role) {
            $datas = ActionModel::where('role_id',$role)->orderBy('pid','asc')->get();
        } else {
            $datas = ActionModel::orderBy('pid','asc')->get();
        }
        return $datas;
    }

    /**
     * 通过角色、操作，获取权限
     */
    public function getRoleAction($action)
    {
        $roleAction = RoleActionModel::where('role_id',$this->id)->where('action_id',$action)->first();
        return $roleAction ? $roleAction : '';
    }

    /**
     * 通过角色，获取权限
     */
    public function getRoleActions()
    {
        $roleActions = RoleActionModel::where('role_id',$this->id)->get();
        return $roleActions ? $roleActions : '';
    }

    public function getActionId($action)
    {
        return $this->getRoleAction($action) ? $this->getRoleAction($action)->action_id  : '';
    }

    /**
     * 当前管理员权限id集合
     */
    public function getActionArr()
    {
        $roleActions = $this->getRoleActions();
        if ($roleActions) {
            foreach ($roleActions as $roleAction) {
                $actionArr[] = $roleAction->action_id;
            }
        }
        return isset($actionArr) ? $actionArr : [];
    }
}