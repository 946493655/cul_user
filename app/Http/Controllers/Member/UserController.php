<?php
namespace App\Http\Controllers\Member;

use App\Models\Admin\LogModel;
use App\Models\CompanyModel;
use App\Models\PersonModel;
use App\Models\UserModel;
use App\Models\UserParamsModel;

class UserController extends BaseController
{
    /**
     * 用户
     */

    public function __construct()
    {
        $this->selfModel = new UserModel();
    }

    /**
     * 用户列表
     */
    public function index()
    {
        $isuser = (isset($_POST['isuser'])&&$_POST['isuser'])?$_POST['isuser']:0;   //用户类型
        $isauth = (isset($_POST['isauth'])&&$_POST['isauth'])?$_POST['isauth']:0;   //审核
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = (isset($_POST['page'])&&$_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $isuserArr = $isuser?[$isuser]:[0,1,2,3,4,5,6,7,50];        //转化isuser为数组
        $isauthArr = $isauth?[$isauth]:[0,1,2,3];                   //转化isauth为数组
        $models = UserModel::whereIn('isuser',$isuserArr)
            ->whereIn('isauth',$isauthArr)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();                 //转化isauth为数组
        $total = UserModel::whereIn('isuser',$isuserArr)
            ->whereIn('isauth',$isauthArr)
            ->count();
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
            $datas[$k] = $this->getArrByModel($model);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 得到所有用户
     */
    public function getUsersByTime()
    {
        $time = $_POST['time'];
        if (!isset($time)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($time=='') {
            $models = UserModel::all();
            $total = UserModel::count();
        } elseif ($time==0) {
            $models = UserModel::where('isauth','>',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $total = UserModel::where('isauth','>',0)
                ->count();
        } elseif ($time) {
            $models = UserModel::where('isauth','>',0)
                ->where('created_at','>',$time)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $total = UserModel::where('isauth','>',0)
                ->where('created_at','>',$time)
                ->count();
        }
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
            $datas[$k] = $this->getArrByModel($model);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 一条用户数据
     */
    public function getOneUser()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }

        $model = UserModel::find($uid);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = $this->getArrByModel($model);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '成功获取用户信息！'
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uname 判断是否存在用户
     */
    public function getOneUserByUname()
    {
        $uname = $_POST['uname'];
        if (!$uname) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserModel::where('username',$uname)->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有该用户！',
                ],
                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->getArrByModel($model);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '成功获取用户数据！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 新用户注册
     */
    public function doRegist()
    {
        $uname = $_POST['username'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $ip = $_POST['ip'];
        $ipaddress = $_POST['ipaddress'];
        $genre = $_POST['genre'];
        $action = $_POST['action'];
        if (!$uname || !$password || !$pwd || !$ip || !$ipaddress || !$genre || !$action) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //判断是否存在用户
        $model = UserModel::where('username',$uname)
            ->where('pwd',$pwd)
            ->first();
        if ($model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '已存在此用户！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //插入数据
        $data = [
            'username'  =>  $uname,
            'password'  =>  $password,
            'pwd'       =>  $pwd,
            'ip'        =>  $ip,
            'created_at'=> time(),
            'lastLogin'=> time(),
        ];
        UserModel::create($data);
        $model2 = UserModel::where('username',$uname)
            ->where('pwd',$pwd)
            ->first();
        //登陆加入用户日志表
        $log = [
            'uname' =>  $uname,
            'genre' =>  $genre,
            'ip'    =>  $ip,
            'ipaddress' =>  $ipaddress,
            'action'    =>  $action,
        ];
        if ($this->insertLog($model2,$log) != true) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '用户日志错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理返回数据
        $datas = $this->getArrByModel($model2);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '注册成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 用户登录
     */
    public function doLogin()
    {
        $uname = $_POST['username'];
        $password = $_POST['password'];
        $pwd = $_POST['pwd'];
        $ip = $_POST['ip'];
        $ipaddress = $_POST['ipaddress'];
        $genre = $_POST['genre'];
        $action = $_POST['action'];
        if (!$uname || !$password || !$pwd || !$ip || !$ipaddress || !$genre || !$action) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //判断是否存在用户
        $model = UserModel::where('username',$uname)
            ->where('pwd',$pwd)
            ->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '用户名或密码错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //登陆加入用户日志表
        $log = [
            'uname' =>  $uname,
            'genre' =>  $genre,
            'ip'    =>  $ip,
            'ipaddress' =>  $ipaddress,
            'action'    =>  $action,
        ];
        if ($this->insertLog($model,$log) != true) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '用户日志错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //最近登录更新
        UserModel::where('id',$model->id)->update(['lastLogin'=> time()]);
        //整理返回数据
        $datas = $this->getArrByModel($model);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '登录成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 插入用户日志表
     */
    public function insertLog($user,$log)
    {
        $serial = date('YmdHis',time()).rand(0,10000);
        $userlog = [
            'uid'=> $user->id,
            'uname'=> $log['uname'],
            'genre'=> $log['genre'],
            'serial'=> $serial,
            'ip'=> $log['ip'],
            'ipaddress'=> $log['ipaddress'],
            'action'=> $log['action'],
            'loginTime'=> time(),
            'created_at'=> $user->created_at,
        ];
        LogModel::create($userlog);
        return true;
    }

    /**
     * 更新用户记录
     */
    public function update()
    {
        $id = $_POST['id'];
        $username = isset($_POST['username'])?$_POST['username']:'';
        $address = isset($_POST['address'])?$_POST['address']:'';
        $email = $_POST['email'];
        $qq = $_POST['qq'];
        $tel = $_POST['tel'];
        $mobile = $_POST['mobile'];
        $area = $_POST['area'];
        if (!$id || !$username) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserModel::where('id',$id)
            ->where('username',$username)
            ->first();;
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'username'  =>  $username,
            'email'     =>  $email,
            'qq'        =>  $qq,
            'tel'       =>  $tel,
            'mobile'    =>  $mobile,
            'address'   =>  $address,
            'area'      =>  $area,
            'updated_at' =>  time(),
        ];
        UserModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '用户基本信息修改成功！'
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 更新用户密码
     */
    public function updatePwd()
    {
        $id = $_POST['id'];
        $newpwdhash = $_POST['newpwdhash'];
        $newpwd = $_POST['newpwd'];
        if (!$id || !$newpwdhash || !$newpwd) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有用户！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'password'  =>  $newpwdhash,
            'pwd'       =>  $newpwd,
        ];
        UserModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '更新成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置审核
     */
    public function setAuth()
    {
        $id = $_POST['uid'];
        $auth = $_POST['auth'];
        if (!$id || !$auth) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        UserModel::where('id',$id)->update(['isauth'=> $auth]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置头像
     */
    public function setHeadImg()
    {
        $id = $_POST['uid'];
        $head = $_POST['head'];
        if (!$id || !$head) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        UserModel::where('id',$id)->update(['head'=> $head]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取个人资料
     */
    public function getPerson($uid)
    {
        if (!$uid) { return array(); }
        $personModel = PersonModel::where('uid',$uid)->first();
        if ($personModel) { $personModel->sexName = $personModel->sexName(); }
        return $personModel ? $this->objToArr($personModel) : [];
    }

    /**
     * 获取企业资料
     */
    public function getCompany($uid)
    {
        if (!$uid) { return array(); }
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $this->objToArr($companyModel) : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $model = [
            'isAuths'    =>  $this->selfModel['isauths'],
            'isUsers'    =>  $this->selfModel['isusers'],
            'isVips'    =>  $this->selfModel['isvips'],
        ];
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'model' =>  $model,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 将 model 转化为 array
     */
    public function getArrByModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['authType'] = $model->authType();
        $data['userType'] = $model->userType();
        $data['vip'] = $model->isvip();
//        $company = CompanyModel::where('uid',$model->id)->first();
//        if (!$company) {
//            $data['company'] = array();
//        } else {
//            $data['company']['name'] = $company->name;
//        }
//        $person = PersonModel::where('uid',$model->id)->first();
//        if (!$person) {
//            $data['person'] = array();
//        } else {
//            $data['person']['realname'] = $person->realname;
//            $data['person']['sexName'] = $person->sexName();
//        }
        return $data;
    }
}