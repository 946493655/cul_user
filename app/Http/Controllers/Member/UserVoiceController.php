<?php
namespace App\Http\Controllers\Member;

use App\Models\UserVoiceModel;

class UserVoiceController extends BaseController
{
    /**
     * 用户心声
     */

    public function __construct()
    {
        parent::__construct();
        $this->selfModel = new UserVoiceModel();
    }

    /**
     * 列表
     */
    public function index()
    {
        $uid = $_POST['uid'];
        $isshow = $_POST['isshow'];
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $isshowArr = $isshow ? [$isshow] : [0,1,2];
        if ($uid) {
            $models = UserVoiceModel::where('uid',$uid)
                ->whereIn('isshow',$isshowArr)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $models = UserVoiceModel::whereIn('isshow',$isshowArr)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
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
            $datas[$k]['isShowName'] = $model->getIsShow();
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['userType'] = $model->getGenreName();
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '获取数据成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 添加心声
     */
    public function store()
    {
        $name = $_POST['name'];
        $uid = $_POST['uid'];
        $work = $_POST['work'];
        $intro = $_POST['intro'];
        if (!$name || !$uid || !$work || !$intro) {
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
            'uid'   =>  $uid,
            'work'  =>  $work,
            'intro' =>  $intro,
            'created_at'    =>  time(),
        ];
        UserVoiceModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '数据添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

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
        $model = UserVoiceModel::find($id);
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
        $datas['isShowName'] = $model->getIsShow();
        $datas['createTime'] = $model->createTime();
        $datas['updateTime'] = $model->updateTime();
        $datas['userType'] = $model->getGenreName();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $uid = $_POST['uid'];
        $work = $_POST['work'];
        $intro = $_POST['intro'];
        if (!$id || !$name || !$uid || !$work || !$intro) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = UserVoiceModel::find($id);
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
            'uid'   =>  $uid,
            'work'  =>  $work,
            'intro' =>  $intro,
            'updated_at'    =>  time(),
        ];
        UserVoiceModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '更新成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $model = [
            'isshows'   =>  $this->selfModel['isshows'],
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
}