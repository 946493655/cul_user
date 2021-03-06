<?php
namespace App\Http\Controllers\Activity;

use App\Models\Wallet\ToWealModel;
use App\Models\Wallet\WalletModel;
use App\Models\Wallet\TipModel;

class WalletController extends BaseController
{
    /**
     * 钱包管理
     * 10签到兑换1福利，30金币兑换1福利，1红包额度兑换1福利
     */

    protected $signToWeal = 10;     //10签到兑换1福利
    protected $goldToWeal = 30;     //30金币兑换1福利
    protected $tipToWeal = 1;       //1红包额度兑换1福利

    /**
     * 用户钱包
     */
    public function index()
    {
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        $models = WalletModel::orderBy('id','desc')
            ->skip($start)
            ->take($limit)
            ->get();
        $total = WalletModel::orderBy('id','desc')
            ->count();
        if (!count($models)) {
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
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['updateTime'] = $model->updateTime();
            $datas[$k]['username'] = $model->getUName();
        }
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
            'data'  =>  $datas,
            'pagelist'  =>  [
                'total' =>  $total,
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid 获取一条记录
     */
    public function getWalletByUid()
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
        $model = WalletModel::where('uid',$uid)->first();
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
        $datas['updateTime'] = $model->updateTime();
        $datas['username'] = $model->getUName();
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
     * 根据 id 获取记录
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
        $model = WalletModel::find($id);
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
        $datas['updateTime'] = $model->updateTime();
        $datas['username'] = $model->getUName();
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
     * 添加钱包功能
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $sign = isset($_POST['sign'])?$_POST['sign']:0;
        $gold = isset($_POST['gold'])?$_POST['gold']:0;
        $tip = isset($_POST['tip'])?$_POST['tip']:0;
        if (!$uid) {
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
            'sign'  =>  $sign,
            'gold'  =>  $gold,
            'tip'   =>  $tip,
            'created_at'    =>  time(),
        ];
        WalletModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 修改钱包数据
     */
    public function update()
    {
        $id = $_POST['id'];
        $uid = $_POST['uid'];
        $sign = isset($_POST['sign'])?$_POST['sign']:0;
        $gold = isset($_POST['gold'])?$_POST['gold']:0;
        $tip = isset($_POST['tip'])?$_POST['tip']:0;
        $weal = isset($_POST['weal'])?$_POST['weal']:'';
        if (!$id || !$uid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = WalletModel::find($id);
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有记录！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $wealNew = $weal=='' ? $model->weal : $weal;
        $data = [
            'uid'   =>  $uid,
            'sign'  =>  $sign,
            'gold'  =>  $gold,
            'tip'   =>  $tip,
            'weal'   =>  $wealNew,
            'updated_at'    =>  time(),
        ];
        WalletModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid，type,number 兑换福利
     * type：1sign，2gold，3tip
     */
    public function setConvert()
    {
        $uid = $_POST['uid'];
        $type = $_POST['type'];
        $number = $_POST['number'];
        if (!$uid || !$type) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $model = WalletModel::where('uid',$uid)->first();
        if (!$model) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -3,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($type==1 && $this->signToWeal*$number>$model->sign) {
            //10签到兑换1福利
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '签到数量不足！',
                ],
            ];
            echo json_encode($rstArr);exit;
        } elseif ($type==2 && $this->goldToWeal*$number>$model->gold) {
            //30金币兑换1福利
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '金币数量不足！',
                ],
            ];
            echo json_encode($rstArr);exit;
        } elseif ($type==3 && $this->tipToWeal*$number>$model->tip) {
            //1红包额度兑换1福利
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '红包额度不足！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        if ($type == 1) {
            $data = [
                'sign'  =>  $model->sign - $number * $this->signToWeal,
                'weal'  =>  $model->weal + $number,
            ];
        } elseif ($type == 2) {
            $data = [
                'gold'  =>  $model->gold - $number * $this->goldToWeal,
                'weal'  =>  $model->weal + $number,
            ];
        } elseif ($type == 3) {
            $data = [
                'tip'  =>  $model->tip - $number * $this->tipToWeal,
                'weal'  =>  $model->weal + $number,
            ];
        }
        WalletModel::where('uid',$uid)->update($data);
        //添加福利兑换记录
        $data1 = [
            'uid'   =>  $uid,
            'genre' =>  $type,
            'val'   =>  $number,
            'created_at'    =>  time(),
        ];
        ToWealModel::create($data1);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 通过 uid 获取福利兑换记录
     */
    public function getConvertRecord()
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
        $models = ToWealModel::where('uid',$uid)->orderBy('id','desc')->get();
        if (!count($models)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = array();
        foreach ($models as $k=>$model) {
            $datas[$k] = $this->objToArr($model);
            $datas[$k]['createTime'] = $model->createTime();
            $datas[$k]['genreName'] = $model->getGenreName();
            if ($model->genre==1) {
                $datas[$k]['originNumber'] = $model->val * $this->signToWeal;
            } elseif ($model->genre==2) {
                $datas[$k]['originNumber'] = $model->val * $this->goldToWeal;
            } elseif ($model->genre==3) {
                $datas[$k]['originNumber'] = $model->val * $this->tipToWeal;
            }
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
     * 获取 model
     */
    public function getModel()
    {
        $model = [
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