<?php
namespace App\Http\Controllers\Activity;

use App\Models\UserSignModel;

class SignController extends BaseController
{
    /**
     * 用户签到
     */

    /**
     * 签到列表
     */
    public function index()
    {
        $uid = isset($_POST['uid'])?$_POST['uid']:0;
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($uid) {
            $signModels = UserSignModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $signModels = UserSignModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();

        }
        if (!count($signModels)) {
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
        foreach ($signModels as $k=>$signModel) {
            $datas[$k]['signStatus'] = $signModel->getSignStatus($signModel,$signModel->created_at);
            $datas[$k]['uname'] = $signModel->getUName();
            $datas[$k]['reward'] = $signModel->reward();
            $datas[$k] = $this->objToArr($signModel);
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
     * 申请签到
     */
    public function store()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '成熟有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $zaoshang = strtotime(date('Ymd',time()).'000000');
        $wanshang = strtotime(date('Ymd',time()).'595959');
        $signModel = UserSignModel::where('uid',$uid)
            ->where('created_at','>',$zaoshang)
            ->where('created_at','<',$wanshang)
            ->first();
        if ($signModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '今天已签到！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '签到成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}