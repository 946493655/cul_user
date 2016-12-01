<?php
namespace App\Http\Controllers\Member;

use App\Models\PersonModel;

class PersonController extends BaseController
{
    /**
     * 个人资料
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
}