<?php
namespace App\Http\Controllers\Activity;

use App\Models\Wallet\WalletModel;
use App\Models\Wallet\GoldModel;

class GoldController extends BaseController
{
    /**
     * 金币
     * 主要用于用户操作后的奖励
     */

    public function __construct()
    {
        $this->selfModel = new GoldModel();
    }

    /**
     * 金币列表
     */
    public function index()
    {
        $uid = $_POST['uid']?$_POST['uid']:0;
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($uid) {
            $models = GoldModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $models = GoldModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();

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
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['genreName'] = $model->genreName();
            $datas[$k]['createTime'] = $model->createTime();
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'model' =>  [],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 添加金币
     * genre：1建议发布奖励1-5，2建议评价奖励6-10，3用户心声奖励1-5，4订单好评奖励5，
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $genre = $_POST['genre'];
        if (!$uid || !$genre) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $wallet = WalletModel::where('uid',$uid)->first();      //获取钱包记录
        if (!$wallet) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '金币总数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($genre==1) {
            $gold = rand(1,5);
        } elseif ($genre==2) {
            $gold = rand(6,10);
        } elseif ($genre==3) {
            $gold = rand(1,5);
        } elseif ($genre==4) {
            $gold = 5;
        }
        $data = [
            'uid'   =>  $uid,
            'genre' =>  $genre,
            'gold'  =>  $gold,
            'created_at'    =>  time(),
        ];
        GoldModel::create($data);

        //计算金币总数
        WalletModel::where('uid',$uid)->update(['gold'=> $wallet->gold + $gold]);

        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '金币添加成功！' ,
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}