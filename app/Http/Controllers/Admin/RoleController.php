<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\RoleActionModel;
use App\Models\Admin\RoleModel;

class RoleController extends BaseController
{
    /**
     * 管理员角色
     */

    public function index()
    {
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $roleModels = RoleModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($roleModels)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($roleModels as $k=>$roleModel) {
            $datas[$k] = $this->objToArr($roleModel);
            $datas[$k]['createTime'] = $roleModel->createTime();
            $datas[$k]['updateTime'] = $roleModel->updateTime();
            $datas[$k]['roleActions'] = $roleModel->getRoleActions();
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 所有角色
     */
    public function all()
    {
        $roles = RoleModel::all();
        return count($roles) ? $roles : [];
    }

    public function store()
    {
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        if (!$name || !isset($intro)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'created_at'    =>  time(),
        ];
        RoleModel::create($data);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        if (!$id || !$name || !isset($intro)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'updated_at'    =>  time(),
        ];
        RoleModel::where('id',$id)->update($data);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '修改成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    public function show()
    {
        $id = $_POST['id'];
        if (!$id) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $roleModel = RoleModel::find($id);
        if (!$roleModel) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($roleModel);
        $datas['createTime'] = $roleModel->createTime();
        $datas['updateTime'] = $roleModel->updateTime();
        $datas['roleActions'] = $roleModel->getRoleActions();
        $datas['actionIds'] = $roleModel->getActionArr();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '修改成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    public function forceDelete()
    {
        $id = $_POST['id'];
        if (!$id) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $roleModel = RoleModel::find($id);
        if (!$roleModel) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        RoleModel::where('id',$id)->delete();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置管理员权限
     */
    public static function setRoleAction()
    {
        $actions = $_POST['action'];
        $id = $_POST['role_id'];
        if (!$id || !$actions) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //多余的就删除
        $roleActions = RoleActionModel::where('role_id',$id)->get();
        if (count($roleActions)) {
            foreach ($roleActions as $roleAction) {
                if (!in_array($roleAction->action_id,$actions)) {
                    RoleActionModel::where('id',$roleAction->id)->delete();
                }
            }
        }
        //没有的就添加
        foreach ($actions as $action) {
            if (!RoleActionModel::where('role_id',$id)->where('action_id',$action)->first()) {
                $data = [
                    'role_id'=> $id,
                    'action_id'=> $action,
                    'created_at'=> time(),
                ];
                RoleActionModel::create($data);
            }
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}