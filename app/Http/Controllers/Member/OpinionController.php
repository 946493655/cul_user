<?php
namespace App\Http\Controllers\Member;

use App\Models\OpinionModel;

class OpinionController extends BaseController
{
    /**
     * 用户意见
     */

    /**
     * 列表
     */
    public function index()
    {
        $isshow = (isset($_POST['isshow'])&&$_POST['isshow'])?$_POST['isshow']:0;     //是否显示
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($isshow) {
            $opinionModels = OpinionModel::where('isshow',$isshow)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $opinionModels = OpinionModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        }
        if (!count($opinionModels)) {
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
        foreach ($opinionModels as $k=>$opinionModel) {
            $datas[$k] = $this->objToArr($opinionModel);
            $datas[$k]['username'] = $opinionModel->getUName();
            $datas[$k]['createTime'] = $opinionModel->createTime();
            $datas[$k]['updateTime'] = $opinionModel->updateTime();
            $datas[$k]['statusName'] = $opinionModel->getStatusName();
            $datas[$k]['isShowName'] = $opinionModel->getIsShow();
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
        $datas = $this->objToArr($opinionModel);
        $datas['username'] = $opinionModel->getUName();
        $datas['createTime'] = $opinionModel->createTime();
        $datas['updateTime'] = $opinionModel->updateTime();
        $datas['statusName'] = $opinionModel->getStatusName();
        $datas['isShowName'] = $opinionModel->getIsShow();
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
     * 设置记录是否删除
     */
    public function setDel()
    {
        $id = $_POST['id'];
        $del = $_POST['del'];
        if (!$id || !isset($del)) {
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
        OpinionModel::where('id',$id)->update(['del'=> $del]);
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
}