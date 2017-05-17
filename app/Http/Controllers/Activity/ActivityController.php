<?php
namespace App\Http\Controllers\Activity;

use App\Models\Wallet\ActivityModel;
use App\Models\Wallet\ActivityUserModel;

class ActivityController extends BaseController
{
    /**
     * 活动接口
     */

    public function __construct()
    {
        $this->selfModel = new ActivityModel();
    }

    public function index()
    {
        $genre = $_POST['genre'];
        $limit = $_POST['limit'];
        $page = $_POST['page'];
        $start = $limit * ($page - 1);
        if (!$genre) {
            $query = ActivityModel::where('del',0);
        } else {
            $query = ActivityModel::where('del',0)
                ->where('genre',$genre);
        }
        $models = $query->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        $total = $query->count();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->getArrByModel($model);
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 genre 获取已领取活动的用户列表
     */
    public function getUsers()
    {
        $genre = $_POST['genre'];
        $limit = $_POST['limit'];
        $page = $_POST['page'];
        $start = $limit * ($page - 1);
        if (!$genre) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $models = ActivityUserModel::where('del',0)
            ->where('act_id',$genre)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        $total = ActivityUserModel::count();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['actName'] = $model->getActivityName();
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 genre 获取已领取活动的用户列表
     */
    public function getUsersByUid()
    {
        $uid = $_POST['uid'];
        $limit = $_POST['limit'];
        $page = $_POST['page'];
        $start = $limit * ($page - 1);
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $models = ActivityUserModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        $total = ActivityUserModel::count();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['actName'] = $model->getActivityName();
            $datas[$k]['genreName'] = $model->getActivityGenreName();
            $datas[$k]['period'] = $model->getActivityPeriod();
            $datas[$k]['isUseName'] = $model->getIsUse();
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 对象转为数据集合
     */
    public function getArrByModel($model)
    {
        $data = $this->objToArr($model);
        $data['createTime'] = $model->createTime();
        $data['updateTime'] = $model->updateTime();
        $data['genreName'] = $model->getGenreName();
        $data['period'] = $model->period();
        return $data;
    }

    /**
     * 获取model集合
     */
    public function getModel()
    {
        $model = [
            'genres'    =>  $this->selfModel['genres'],
        ];
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'model'  =>  $model,
        ];
        echo json_encode($rstArr);exit;
    }
}