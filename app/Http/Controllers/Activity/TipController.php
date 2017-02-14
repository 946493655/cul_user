<?php
namespace App\Http\Controllers\Activity;

use App\Models\Wallet\TipModel;

class TipController extends BaseController
{
    /**
     * 红包控制器
     * 主要用于活动、节日等给用户的福利
     */

    public function __construct()
    {
        $this->selfModel = new TipModel();
    }

    /**
     * 红包列表
     */
    public function index()
    {
        $uid = (isset($_POST['uid'])&&$_POST['uid'])?$_POST['uid']:0;
        $type = (isset($_POST['type'])&&$_POST['type'])?$_POST['type']:0;
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($uid && $type) {
            $models = TipModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif (!$uid && $type) {
            $models = TipModel::where('type',$type)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif ($uid && !$type) {
            $models = TipModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $models = TipModel::orderBy('id','desc')
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
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['typeName'] = $model->getTypeName();
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid、type 获取一条记录
     */
    public function getTipByUid()
    {
        $uid = $_POST['uid'];
        $type = $_POST['type'];
        if (!$uid || !$type) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = TipModel::where('uid',$uid)->where('type',$type)->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($model);
        $datas['createTime'] = $model->createTime();
        $datas['updateTime'] = $model->updateTime();
        $datas['username'] = $model->getUName();
        $datas['typeName'] = $model->getTypeName();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 增加记录
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $type = $_POST['type'];
        $tip = $_POST['tip'];
        if (!$uid || !$type || !$tip) {
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
            'type'  =>  $type,
            'tip'   =>  $tip,
            'created_at'    =>  time(),
        ];
        TipModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}