<?php
namespace App\Http\Controllers\Member;

use App\Models\CompanyModel;
use App\Models\PersonModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    /**
     * 用户
     */

    /**
     * 用户列表
     */
    public function index()
    {
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $userModels = UserModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($userModels)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
//                'data'  =>  [],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($userModels as $k=>$userModel) {
            $datas[$k] = $this->objToArr($userModel);
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
     * 一条用户数据
     */
    public function getOneUser()
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

        $userModel = UserModel::find($uid);
        if (!$userModel) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = $this->objToArr($userModel);
        $datas['person'] = $this->getPerson($uid);
        $datas['company'] = $this->getCompany($uid);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '成功获取用户信息！'
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取个人资料
     */
    public function getPerson($uid)
    {
        if (!$uid) { return array(); }
        $personModel = PersonModel::where('uid',$uid)->first();
        return $personModel ? $this->objToArr($personModel) : [];
    }

    /**
     * 获取企业资料
     */
    public function getCompany($uid)
    {
        if (!$uid) { return array(); }
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $this->objToArr($companyModel) : [];
    }
}