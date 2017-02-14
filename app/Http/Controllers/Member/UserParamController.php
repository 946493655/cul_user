<?php
namespace App\Http\Controllers\Member;

use App\Models\UserParamsModel;

class UserParamController extends BaseController
{
    /**
     * 用户参数
     */

    /**
     * 获取用户参数
     */
    public function getUserParamByUid()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $param = UserParamsModel::where('uid',$uid)->first();
        if (!$param) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有此用户的自定义参数！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($param);
        $datas['created_at'] = $param->createTime();
        $datas['updated_at'] = $param->createTime();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '获取参数成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置个人后台顶部背景
     */
    public function setTopBg()
    {
        $uid = $_POST['uid'];
        $pic_id = $_POST['pic_id'];
        if (!$uid || !$pic_id) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $param = UserParamsModel::where('uid',$uid)->first();
        if (!$param) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $update = [
            'per_top_bg_img'    =>  $pic_id,
            'updated_at'        =>  time(),
        ];
        UserParamsModel::where('uid',$uid)->update($update);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}