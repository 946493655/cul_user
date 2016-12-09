<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\LogModel;

class LogController extends BaseController
{
    /**
     * 用户、管理员日志
     */

    /**
     * 列表
     */
    public function index()
    {
        $genre = $_POST['genre'];       //1用户日志，2管理员日志
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$genre) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }

        $logModels = LogModel::where('genre',$genre)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($logModels)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($logModels as $k=>$logModel) {
            $datas[$k] = $this->objToArr($logModel);
            $datas[$k]['username'] = $logModel->getUname();
            $datas[$k]['genreName'] = $logModel->getGenreName();
            $datas[$k]['loginTime'] = $logModel->loginTime();
            $datas[$k]['logoutTime'] = $logModel->logoutTime();
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
     * 根据时间获取日志
     */
    public function getLogsByTime()
    {
        $genre = $_POST['genre'];
        $time = $_POST['time'];
        if (!$genre || !isset($time)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($time==0) {
            $logModels = LogModel::where('genre',$genre)
                ->distinct('uid')
                ->get();
        } elseif ($time) {
            $logModels = LogModel::where('genre',$genre)
                ->where('loginTime','>',time()-3600)
                ->distinct('uid')
                ->get();
        }
        if (!count($logModels)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($logModels as $k=>$logModel) {
            $datas[$k] = $this->objToArr($logModel);
            $datas[$k]['username'] = $logModel->getUname();
            $datas[$k]['genreName'] = $logModel->getGenreName();
            $datas[$k]['loginTime'] = $logModel->loginTime();
            $datas[$k]['logoutTime'] = $logModel->logoutTime();
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
     * 添加日志
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $uname = $_POST['uname'];
        $genre = $_POST['genre'];
        $action = $_POST['action'];
        $serial = $_POST['serial'];
        $ip = $_POST['ip'];
        $ipaddress = $_POST['ipaddress'];
        if (!$uid || !$uname || !$genre || !$action || !$serial || !$ip || !$ipaddress) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'uid'   =>  $uid,
            'uname' =>  $uname,
            'genre' =>  $genre,
            'action'    =>  $action,
            'serial'    =>  $serial,
            'ip'        =>  $ip,
            'ipaddress' =>  $ipaddress,
            'loginTime' =>  time(),
        ];
        LogModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '日志插入成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置日志退出登录时间
     */
    public function logout()
    {
        $serial = $_POST['serial'];
        if (!$serial) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        LogModel::where('serial',$serial)->update(['logoutTime'=> time()]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '退出成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 id 获取一条记录
     */
    public function show()
    {
        $id = $_POST['id'];
        if (!$id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $logModel = LogModel::find($id);
        if (!$logModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($logModel);
        $datas['username'] = $logModel->getUname();
        $datas['genreName'] = $logModel->getGenreName();
        $datas['loginTime'] = $logModel->loginTime();
        $datas['logoutTime'] = $logModel->logoutTime();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }
}