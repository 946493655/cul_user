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
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $logModels = LogModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($logModels)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
//                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($logModels as $k=>$logModel) {
            $datas[$k] = $this->objToArr($logModel);
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
}