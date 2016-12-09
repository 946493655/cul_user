<?php
namespace App\Http\Controllers\Member;

use App\Models\PersonModel;

class PersonController extends BaseController
{
    /**
     * 个人资料
     */

    /**
     * 通过 uid 获取个人资料
     */
    public function getOnePerson()
    {
        $uid = $_POST['uid'];
        if (!$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数错误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }

        $personModel = PersonModel::where('uid',$uid)->first();
        if (!$personModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($personModel);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '个人信息获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 新增个人资料
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $realname = $_POST['realname'];
        $sex = $_POST['sex'];
        $idcard = $_POST['idcard'];
        $idfront = $_POST['idfront'];
        if (!$uid || !$realname || !$sex || !isset($idcard) ||!isset($idfront)) {
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
            'realname'  =>  $realname,
            'sex'   =>  $sex,
            'idcard'    =>  $idcard,
            'idfront'   =>  $idfront,
            'created_at'    =>  time(),
        ];
        PersonModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '个人资料添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}