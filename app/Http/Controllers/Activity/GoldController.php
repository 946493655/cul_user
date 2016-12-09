<?php
namespace App\Http\Controllers\Activity;

use App\Models\UserGoldModel;

class GoldController extends BaseController
{
    /**
     * 金币
     */

    /**
     * 金币列表
     */
    public function index()
    {
        $uid = $_POST['uid']?$_POST['uid']:0;
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if ($uid) {
            $goldModels = UserGoldModel::where('uid',$uid)
                ->orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } else {
            $goldModels = UserGoldModel::orderBy('id','desc')
                ->skip($start)
                ->take($limit)
                ->get();

        }
        if (!count($goldModels)) {
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
        foreach ($goldModels as $k=>$goldModel) {
            $datas[$k]['uname'] = $goldModel->getUName();
            $datas[$k]['gold'] = $goldModel->gold();
            $datas[$k] = $this->objToArr($goldModel);
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
     * 添加金币
     */
    public function store()
    {
        $uid = $_POST['uid'];
        $genre = $_POST['genre'];
        $gold = $_POST['gold'];
        if (!$uid || !$genre || !$gold) {
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
            'genre' =>  $genre,
            'gold'  =>  $gold,
            'created_at'    =>  time(),
        ];
        UserGoldModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '金币添加成功！' ,
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}