<?php
namespace App\Http\Controllers\Member;

use App\Models\CompanyModel;

class CompanyController extends BaseController
{
    /**
     * 个人资料
     */

    public function __construct()
    {
        parent::__construct();
        $this->selfModel = new CompanyModel();
    }

    /**
     * 获取公司列表
     */
    public function index()
    {
        $genre = $_POST['genre']?$_POST['genre']:0;
        $limit = isset($_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($genre) {
            $models = CompanyModel::where('genre',$genre)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $models = CompanyModel::orderBy('id','desc')
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
            $datas[$k]['genreName'] = $model->genreName();
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid 获取一条公司数据
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

        $model = CompanyModel::where('uid',$uid)->first();
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
        $datas['genreName'] = $model->genreName();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 新增公司
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $area = $_POST['area'];
        $address = $_POST['address'];
        $yyzzid = $_POST['yyzzid'];
        if (!$uid || !$name || !$area || !$address || !isset($yyzzid)) {
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
            'name'  =>  $name,
            'area'  =>  $area,
            'address'   =>  $address,
            'yyzzid'    =>  $yyzzid,
            'created_at'    =>  time(),
        ];
        CompanyModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  [
                    'code'  =>  0,
                    'msg'   =>  '操作成功！',
                ],
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 cid 获取一条记录
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
        $model = CompanyModel::find($id);
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
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '获取成功！',
            ],
            'data'  =>  $datas,
        ];
        echo json_encode($rstArr);exit;

    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $model = [
            'genres'    =>  $this->selfModel['genres'],
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