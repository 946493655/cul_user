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
        //转化isuser为数组
        if ($isuser) {
            $isuser = is_array($isuser)?$isuser:[$isuser];
        } else {
            $isuser = array();
        }

        if ($isuser && $isauth) {
            $userModels = UserModel::whereIn('isuser',$isuser)
                ->where('isauth',$isauth)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif (!$isuser && $isauth) {
            $userModels = UserModel::where('isauth',$isauth)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif ($isuser && !$isauth) {
            $userModels = UserModel::whereIn('isuser',$isuser)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif (!$isuser && !$isauth) {
            $userModels = UserModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        }
        if (!count($userModels)) {
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
        foreach ($userModels as $k=>$userModel) {
            $datas[$k] = $this->objToArr($userModel);
            $datas[$k]['createTime'] = $userModel->createTime();
            $datas[$k]['updateTime'] = $userModel->updateTime();
            $datas[$k]['authType'] = $userModel->authType();
            $datas[$k]['userType'] = $userModel->userType();
            $datas[$k]['vip'] = $userModel->isvip();
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
            $userModels = UserModel::all();
        } elseif ($time==0) {
            $userModels = UserModel::where('isauth','>',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($time) {
            $userModels = UserModel::where('isauth','>',0)
                ->where('created_at','>',$time)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        if (!count($userModels)) {
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
        foreach ($userModels as $k=>$userModel) {
            $datas[$k] = $this->objToArr($userModel);
            $datas[$k]['createTime'] = $userModel->createTime();
            $datas[$k]['updateTime'] = $userModel->updateTime();
            $datas[$k]['userType'] = $userModel->userType();
            $datas[$k]['authType'] = $userModel->authType();
            $datas[$k]['userType'] = $userModel->userType();
            $datas[$k]['vip'] = $userModel->isvip();
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

        $userModel = UserModel::find($uid);
        if (!$userModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = $this->objToArr($userModel);
        $datas['createTime'] = $userModel->createTime();
        $datas['updateTime'] = $userModel->updateTime();
        $datas['person'] = $this->getPerson($uid);
        $datas['company'] = $this->getCompany($uid);
        $datas['authType'] = $userModel->authType();
        $datas['userType'] = $userModel->userType();
        $datas['vip'] = $userModel->isvip();
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
     * 获取个人资料
     */
    public function getPerson($uid)
    {
        if (!$uid) { return array(); }
        $personModel = PersonModel::where('uid',$uid)->first();
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
        $userModel = UserModel::where('username',$uname)->first();
        if (!$userModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有该用户！',
                ],
                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($userModel);
        $datas['createTime'] = $userModel->createTime();
        $datas['updateTime'] = $userModel->updateTime();
        $datas['person'] = $this->getPerson($userModel->id);
        $datas['company'] = $this->getCompany($userModel->id);
        $datas['authType'] = $userModel->authType();
        $datas['userType'] = $userModel->userType();
        $datas['vip'] = $userModel->isvip();
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
        $userModel = UserModel::where('username',$uname)
            ->where('pwd',$pwd)
            ->first();
        if ($userModel) {
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

        $userModel2 = UserModel::where('username',$uname)
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
        if ($this->insertLog($userModel2,$log) != true) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '用户日志错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理返回数据
        $datas = $this->objToArr($userModel2);
        $datas['person'] = $this->getPerson($userModel2->id);
        $datas['company'] = $this->getCompany($userModel2->id);
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
        $userModel = UserModel::where('username',$uname)
            ->where('pwd',$pwd)
            ->first();
        if (!$userModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有此用户！',
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
        if ($this->insertLog($userModel,$log) != true) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '用户日志错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //最近登录更新
        UserModel::where('id',$userModel->id)->update(['lastLogin'=> time()]);
        //整理返回数据
        $datas = $this->objToArr($userModel);
        $datas['person'] = $this->getPerson($userModel->id);
        $datas['company'] = $this->getCompany($userModel->id);
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
        $email = $_POST['email'];
        $qq = $_POST['qq'];
        $tel = $_POST['tel'];
        $mobile = $_POST['mobile'];
        $isuser = $_POST['isuser'];
        if (!$id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '用户基本参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //假如用户类型为0，则用户类型是原记录类型
        if ($isuser==0) {
            $userModel = UserModel::find($id);
            $isuser = $userModel->isuser;
        }
        $data = [
            'email' =>  $email,
            'qq'    =>  $qq,
            'tel'   =>  $tel,
            'mobile'    =>  $mobile,
            'isuser'    =>  $isuser,
            'update_at' =>  time(),
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
     * 获取用户参数
     */
    public function getUserParamByUid()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $param = UserParamsModel::where('uid',$uid)->first();
        if (!$param) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有此用户的自定义参数！',
                ],
            ];
            echo json_encode($rstArr);exit;
//            //没有记录，新增记录
//            $data = [
//                'uid'   =>  $uid,
//                'limit' =>  10,     //给个默认值
//                'created_at'    =>  time(),
//            ];
//            UserParamsModel::create($data);
//            $param = UserParamsModel::where('uid',$uid)->first();
        }
        $datas = $this->objToArr($param);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '获取参数成功！',
            ],
            'data'  =>  $datas,
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
        $userModel = UserModel::find($id);
        if (!$userModel) {
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
}