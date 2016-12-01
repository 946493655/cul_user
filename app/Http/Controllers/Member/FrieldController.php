<?php
namespace App\Http\Controllers\Member;

use App\Models\UserFrieldModel;

class FrieldController extends BaseController
{
    /**
     * 好友
     */

    /**
     * 获取某用户的所有好友
     */
    public function getFrieldsByUid()
    {
        $uid = $_POST['uid'];
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$uid) {
            $rstArr = [
                'error' =>  -1,
                'msg'   =>  '参数有误！',
            ];
            echo json_encode($rstArr);exit;
        }
        $frieldModels = UserFrieldModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($frieldModels)) {
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
        foreach ($frieldModels as $k=>$frieldModel) {
            $datas[$k] = $this->objToArr($frieldModels);
        }
        $rstArr = [
            'error' => [
                'code'  =>  0,
                'msg'   =>  '成功获取数据！',
            ],
            'data'  =>  $datas,
        ];
//        echo "<pre>";var_dump($datas);exit;
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
                    'msg'   =>  '不能加自己为好友！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $ids = [$uid,$frield];
        $frieldModel = UserFrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->first();
        if ($frieldModel) {
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
        UserFrieldModel::create($data);
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
    public function getPass()
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
                    'msg'   =>  '通过有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $ids = [$uid,$frield];
        $frieldModel = UserFrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->where('isauth',1)
            ->first();
        if (!$frieldModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //通过申请
        UserFrieldModel::where('del',0)
            ->where('uid',$uid)
            ->where('frield_id',$frield)
            ->where('isauth',1)
            ->update(['isauth'=> 3, 'authTime'=> time()]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '成功通过！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 拒绝申请
     */
    public function getRefuse()
    {
        $uid = $_POST['uid'];
        $frield = $_POST['frield_id'];
        $remarks2 = $_POST['remarks2'];
        if (!$uid || !$frield || !$remarks2) {
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
                    'msg'   =>  '拒绝有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $ids = [$uid,$frield];
        $frieldModel = UserFrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->where('isauth',1)
            ->first();
        if (!$frieldModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //拒绝申请
        $data = [
            'isauth'    =>  2,
            'remarks2'  =>  $remarks2,
            'authTime'  =>  time(),
        ];
        UserFrieldModel::where('del',0)
            ->where('uid',$uid)
            ->where('frield_id',$frield)
            ->where('isauth',1)
            ->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '成功拒绝！',
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
        $frieldModel = UserFrieldModel::where('del',0)
            ->whereIn('uid',$ids)
            ->whereIn('frield_id',$ids)
            ->first();
        if (!$frieldModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        UserFrieldModel::where('id',$frieldModel->id)->update(['del'=> 1]);
    }
}