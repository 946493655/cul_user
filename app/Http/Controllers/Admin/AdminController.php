<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminModel;

class AdminController extends BaseController
{
    /**
     * 管理员管理
     */

    /**
     * 管理员列表
     */
    public function index()
    {
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $models = AdminModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($models)) {
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
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['roleName'] = $model->getRoleName();
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
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
     * 获取一位管理员信息
     */
    public function getOneAdmin()
    {
        $admin_id = $_POST['admin_id'];
        if (!$admin_id) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = AdminModel::find($admin_id);
        if (!$model) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($model);
        $datas['roleName'] = $model->getRoleName();
        $datas['createTime'] = $model->createTime();
        $datas['updateTime'] = $model->updateTime();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 admin_name 得到管理员记录
     */
    public function getOneAdminByUname()
    {
        $uname = $_POST['username'];
        if (!$uname) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = AdminModel::where('username',$uname)->first();
        if (!$model) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($model);
        $datas['roleName'] = $model->getRoleName();
        $datas['createTime'] = $model->createTime();
        $datas['updateTime'] = $model->updateTime();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 新增管理员
     */
    public function store()
    {
        $uname = $_POST['username'];
        $realname = $_POST['realname'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $role_id = $_POST['role_id'];
        $intro = $_POST['intro'];
        if (!$uname || !$realname || !$password || !$pwd || !$role_id || !isset($intro)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'username'  =>  $uname,
            'realname'  =>  $realname,
            'password'  =>  $password,
            'pwd'       =>  $pwd,
            'role_id'   =>  $role_id,
            'intro'     =>  $intro,
            'created_at'    =>  time(),
        ];
        AdminModel::create($data);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 修改管理员
     */
    public function update()
    {
        $id = $_POST['id'];
        $uname = $_POST['username'];
        $realname = $_POST['realname'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $role_id = $_POST['role_id'];
        $intro = $_POST['intro'];
        if (!$id || !$uname || !$realname || !$password || !$pwd || !$role_id || !isset($intro)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = AdminModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'username'  =>  $uname,
            'realname'  =>  $realname,
            'password'  =>  $password,
            'pwd'       =>  $pwd,
            'role_id'   =>  $role_id,
            'intro'     =>  $intro,
            'updated_at'    =>  time(),
        ];
        AdminModel::where('id',$id)->update($data);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '修改成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 销毁管理员记录
     */
    public function delete()
    {
        $id = $_POST['admin_id'];
        if (!$id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = AdminModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        AdminModel::where('id',$id)->delete();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '销毁成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}