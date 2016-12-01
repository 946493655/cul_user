<?php
namespace App\Http\Controllers\Member;

use App\Models\CompanyModel;

class CompanyController extends BaseController
{
    /**
     * 个人资料
     */

    /**
     * 获取公司列表
     */
    public function index()
    {
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $companyModels = CompanyModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        if (!count($companyModels)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有公司数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        //整理数据
        $datas = array();
        foreach ($companyModels as $k=>$companyModel) {
            $datas[$k] = $this->objToArr($companyModel);
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '公司数据获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 获取一条公司数据
     */
    public function getOneCompany()
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

        $personModel = CompanyModel::where('uid',$uid)->first();
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
                'msg'   =>  '公司资料获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }
}