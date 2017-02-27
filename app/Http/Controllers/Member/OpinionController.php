<?php
namespace App\Http\Controllers\Member;

use App\Models\OpinionModel;

class OpinionController extends BaseController
{
    /**
     * 用户意见
     */

    public function __construct()
    {
        $this->selfModel = new OpinionModel();
    }

    /**
     * 列表
     */
    public function index()
    {
        $status = isset($_POST['status'])?$_POST['status']:0;
        $isshow = (isset($_POST['isshow'])&&$_POST['isshow'])?$_POST['isshow']:0;     //是否显示
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $statusArr = $status ? [$status] : [0,1,2,3,4,5];       //意见状态转数组
        $isshowArr = $isshow ? [$isshow] : [0,1,2];             //是否显示转数组
        $models = OpinionModel::whereIn('status',$statusArr)
            ->whereIn('isshow',$isshowArr)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['statusName'] = $model->getStatusName();
            $datas[$k]['isShowName'] = $model->getIsShow();
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取数据成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'statuss'    =>  $this->selfModel['statuss'],
                'isshows'    =>  $this->selfModel['isshows'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 根据 uid、from、to 获取数据集合
     */
    public function getOpinionsByTime()
    {
        $uid = $_POST['uid'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if (!$from || $to) {
            $models = OpinionModel::where('uid',$uid)
                ->where('isshow',2)
                ->get();
        } else {
            $models = OpinionModel::where('uid',$uid)
                ->where('created_at','>',$from)
                ->where('isshow',2)
                ->get();
        }
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['statusName'] = $model->getStatusName();
            $datas[$k]['isShowName'] = $model->getIsShow();
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取数据成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'statuss'    =>  $this->selfModel['statuss'],
                'isShows'    =>  $this->selfModel['isshows'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 新增意见
     */
    public function store()
    {
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $uid = $_POST['uid'];
        if (!$name || !$intro || !$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'uid'   =>  $uid,
            'created_at'    =>  time(),
        ];
        OpinionModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 修改意见
     */
    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $uid = $_POST['uid'];
        if (!$id || !$name || !$intro || !$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = OpinionModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'uid'   =>  $uid,
            'updated_at'    =>  time(),
        ];
        OpinionModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取一条记录
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
        $model = OpinionModel::find($id);
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
        $datas['username'] = $model->getUName();
        $datas['createTime'] = $model->createTime();
        $datas['updateTime'] = $model->updateTime();
        $datas['statusName'] = $model->getStatusName();
        $datas['isShowName'] = $model->getIsShow();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取数据成功！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'statuss'    =>  $this->selfModel['statuss'],
                'isShows'    =>  $this->selfModel['isshows'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置记录是否删除
     */
    public function setShow()
    {
        $id = $_POST['id'];
        $isshow = $_POST['isshow'];
        if (!$id || !in_array($isshow,[1,2])) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $opinionModel = OpinionModel::find($id);
        if (!$opinionModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        OpinionModel::where('id',$id)->update(['isshow'=> $isshow]);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 销毁记录
     */
    public function forceDelete()
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
        $opinionModel = OpinionModel::find($id);
        if (!$opinionModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        OpinionModel::where('id',$id)->delete();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '销毁成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置意见状态
     */
    public function setStatus()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $remarks = $_POST['remarks'];
        if (!$id || !$status) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($status==4 && !$remarks) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '不满意时，理由必填！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = OpinionModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'status'    =>  $status,
            'remarks'   =>  $remarks,
        ];
        OpinionModel::where('id',$id)->update($data);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 清空表
     */
    public function clearTable()
    {
        $models = OpinionModel::all();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '表中没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        OpinionModel::truncate();
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}