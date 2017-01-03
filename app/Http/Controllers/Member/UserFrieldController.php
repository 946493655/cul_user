<?php
namespace App\Http\Controllers\Member;

use App\Models\FrieldModel;
use App\Models\UserModel;

class UserFrieldController extends BaseController
{
    /**
     * 好友
     */

    public function __construct()
    {
        $this->selfModel = new FrieldModel();
    }

    /**
     * 获取某用户的所有好友
     */
    public function index()
    {
        $uid = $_POST['uid'];
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

//        if (!$uid) {
//            $rstArr = [
//                'error' =>  -1,
//                'msg'   =>  '参数有误！',
//            ];
//            echo json_encode($rstArr);exit;
//        }
        if ($uid) {
            $models = FrieldModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $models = FrieldModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        }
        if (!count($models)) {
            $rstArr = [
                'error' => [
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
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->UpdateTime();
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['frieldName'] = $model->getFrieldName();
            $datas[$k]['user_pic'] = $model->getHead($model->uid);
            $datas[$k]['frield_pic'] = $model->getHead($model->frield_id);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'isauths'   =>  $this->selfModel['isauths'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid 获取朋友列表
     */
    public function getFrieldsByUid()
    {
        $uid = $_POST['uid'];
        $limit = $_POST['limit'];
        if (!$uid || !$limit) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $models = FrieldModel::where('del',0)
//            ->where(function($query){
//                $query->where('uid',$uid)
//                    ->where('frield_id',$uid);
//            })
            ->where('uid',$uid)
            ->orWhere('frield_id',$uid)
            ->where('isauth',2)
            ->orderBy('id','desc')
            ->paginate($limit);
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
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['authTime'] = $model->authTime();
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['frieldName'] = $model->getFrieldName();
            $datas[$k]['user_pic'] = $model->getHead($model->uid);
            $datas[$k]['frield_pic'] = $model->getHead($model->frield_id);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'isauths'   =>  $this->selfModel['isauths'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过条件找朋友
     */
    public function getFrieldsByMenu()
    {
        //m==0:我的好友;1:新的申请;
        $uid = $_POST['uid'];
        $menu = (isset($_POST['menu'])&&$_POST['menu'])?$_POST['menu']:0;
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$uid || !isset($menu)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($menu==0) {
            $models = FrieldModel::where('del',0)
                ->where('isauth',3)
                ->where('uid',$uid)
                ->orWhere('frield_id',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif ($menu==1) {
            $models = FrieldModel::where('del',0)
                ->where('isauth',1)
                ->where('uid',$uid)
                ->orWhere('frield_id',$uid)
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
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->UpdateTime();
            $datas[$k]['username'] = $model->getUName();
            $datas[$k]['frieldName'] = $model->getFrieldName();
            $datas[$k]['user_pic'] = $model->getHead($model->uid);
            $datas[$k]['frield_pic'] = $model->getHead($model->frield_id);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'isauths'   =>  $this->selfModel['isauths'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 寻找新的好友
     */
    public function getNewFrields()
    {
        $uid = $_POST['uid'];
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //好友用户id集合
        $frields = FrieldModel::where('del',0)
            ->where('uid',$uid)
            ->orWhere('frield_id',$uid)
            ->get();
        $frieldIds = array();
        if (count($frields)) {
            foreach ($frields as $frield) {
                if ($uid==$frield->uid) {
                    $frieldIds[] = $frield->frield_id;
                } elseif ($uid==$frield->frield_id) {
                    $frieldIds[] = $frield->uid;
                }
            }
        }
        $frieldIds[] = $uid;
        array_unique($frieldIds);
        //获取非好友用户
        $userModels = UserModel::whereNotIn('id',$frieldIds)
            ->orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($userModels)) {
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
        foreach ($userModels as $k=>$userModel) {
            $datas[$k] = $this->objToArr($userModel);
            $datas[$k]['createTime'] = $userModel->createTime();
            $datas[$k]['updateTime'] = $userModel->UpdateTime();
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
     * 通过 uid 查找一条朋友记录
     */
    public function getOneFrield()
    {
        $id = $_POST['id'];
        if (!$id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = FrieldModel::find($id);
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
        $datas['updateTime'] = $model->UpdateTime();
        $datas['username'] = $model->getUName();
        $datas['frieldName'] = $model->getFrieldName();
        $datas['user_pic'] = $model->getHead($model->uid);
        $datas['frield_pic'] = $model->getHead($model->frield_id);
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
            'model' =>  [
                'isauths'   =>  $this->selfModel['isauths'],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 申请好友
     */
    public function getApply()
    {
        $uid = $_POST['uid'];
        $frield = $_POST['frield_id'];
        $remarks = $_POST['remarks'];
        if (!$uid || !$frield || !$remarks) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($uid == $frield) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '不能加自己为好友！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $ids = [$uid,$frield];
        $model = FrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->first();
        if ($model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '对方已是你的好友！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'uid'   =>  $uid,
            'frield_id' =>  $frield,
            'isauth'    =>  1,          //1代表申请
            'remarks'   =>  $remarks?$remarks:'',
            'created_at'    =>  time(),
        ];
        FrieldModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '申请好友成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过申请
     */
    public function setFrieldAuth()
    {
        $id = $_POST['id'];
        $isauth = $_POST['isauth'];
        $remarks2 = $_POST['remarks2'];
        if (!$id || !$isauth) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = FrieldModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $update = [
            'isauth'    =>  $isauth,
            'remarks2'  =>  $remarks2,
            'authTime'  =>  time(),
        ];
        FrieldModel::where('id',$id)->update($update);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 删除好友
     */
    public function setDel()
    {
        $uid = $_POST['uid'];
        $frield = $_POST['frield_id'];
        if (!$uid || !$frield) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($uid == $frield) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '删除有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $ids = [$uid,$frield];
        $model = FrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        FrieldModel::where('id',$model->id)->update(['del'=> 1]);
    }
}