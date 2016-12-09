<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\ActionModel;
use App\Models\Admin\RoleActionModel;

class ActionController extends BaseController
{
    /**
     * 系统后台 action 菜单
     */

    public function index()
    {
        $isshow = (isset($_POST['isshow'])&&$_POST['isshow'])?$_POST['isshow']:0;
        $pid = (isset($_POST['pid'])&&$_POST['pid'])?$_POST['pid']:0;
        $limit = (isset($_POST['limit'])&&$_POST['limit'])?$_POST['limit']:$this->limit;     //每页显示记录数
        $page = isset($_POST['page'])?$_POST['page']:1;         //页码，默认第一页
        $start = $limit * ($page - 1);      //记录起始id

        if (!$isshow && !$pid) {
            $actionModels = ActionModel::orderBy('id','desc')
                ->orderBy('sort','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif ($isshow && !$pid) {
            $actionModels = ActionModel::where('isshow',$isshow)
                ->orderBy('id','desc')
                ->orderBy('sort','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif (!$isshow && $pid) {
            $actionModels = ActionModel::where('pid',$pid)
                ->orderBy('id','desc')
                ->orderBy('sort','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        } elseif ($isshow && $pid) {
            $actionModels = ActionModel::where('isshow',$isshow)
                ->where('pid',$pid)
                ->orderBy('id','desc')
                ->orderBy('sort','desc')
                ->skip($start)
                ->take($limit)
                ->get();
        }
        if (!count($actionModels)) {
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
        foreach ($actionModels as $k=>$actionModel) {
            $datas[$k] = $this->objToArr($actionModel);
            $datas[$k]['createTime'] = $actionModel->createTime();
            $datas[$k]['updateTime'] = $actionModel->updateTime();
            $datas[$k]['parentName'] = $actionModel->getParentName();
            $datas[$k]['isShow'] = $actionModel->getIsShow();
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
     * 获取所有 action
     */
    public function actionAll()
    {
        $actions = ActionModel::where('isshow',2)->get();
        if (!count($actions)) {
            $rstArr = [
                'error' => [
                    'code'  =>  -2,
                    'msg'   =>  '未获取到数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $datas = $this->objToArr($actions);
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
     * 系统后台左侧菜单
     */
    public function getAdminMenus()
    {
        $role_id = (isset($_POST['role_id'])&&$_POST['role_id'])?$_POST['role_id']:0;
        if ($role_id) {
            $actionArr = array();
            $roleActions = RoleActionModel::where('role_id',$role_id)->get();
            foreach ($roleActions as $roleAction) {
                $actionArr[] = $roleAction->action_id;
            }
            $actionModels = ActionModel::whereIn('id',$actionArr)
                ->where('isshow',2)
                ->orderBy('sort','desc')
                ->get();
        } else {
            $actionModels = ActionModel::where('isshow',2)
                ->orderBy('sort','desc')
                ->get();
        }
        if (!count($actionModels)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        foreach ($actionModels as $k=>$actionModel) {
            $datas[$k] = $this->objToArr($actionModel);
            $datas[$k]['createTime'] = $actionModel->createTime();
            $datas[$k]['updateTime'] = $actionModel->updateTime();
            $datas[$k]['parentName'] = $actionModel->getParentName();
            $datas[$k]['isShow'] = $actionModel->getIsShow();
        }
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
     * 通过 pid 得到记录
     */
    public function getActionsByPid()
    {
        $pid = $_POST['pid'];
        if (!isset($pid)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $actionModels = ActionModel::where('pid',$pid)->get();
        if (!count($actionModels)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -2,
                    'msg'   =>  '没有数据！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        foreach ($actionModels as $k=>$actionModel) {
            $datas[$k] = $this->objToArr($actionModel);
            $datas[$k]['createTime'] = $actionModel->createTime();
            $datas[$k]['updateTime'] = $actionModel->updateTime();
            $datas[$k]['parentName'] = $actionModel->getParentName();
            $datas[$k]['isShow'] = $actionModel->getIsShow();
        }
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
     * 新增 action
     */
    public function store()
    {
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $namespace = $_POST['namespace'];
        $controller_prefix = $_POST['controller_prefix'];
        $url = $_POST['url'];
        $action = $_POST['action'];
        $style_class = $_POST['style_class'];
        if (!$name || !isset($intro) || $namespace || !$controller_prefix || !$url || !$action || !isset($style_class)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'namespace' =>  $namespace,
            'controller_prefix' =>  $controller_prefix,
            'url'   =>  $url,
            'action'    =>  $action,
            'style_class'   =>  $style_class,
            'created_at'    =>  time(),
        ];
        ActionModel::create($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '添加成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 修改 action
     */
    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $intro = $_POST['intro'];
        $namespace = $_POST['namespace'];
        $controller_prefix = $_POST['controller_prefix'];
        $url = $_POST['url'];
        $action = $_POST['action'];
        $style_class = $_POST['style_class'];
        if (!$id || !$name || !isset($intro) || $namespace || !$controller_prefix || !$url || !$action || !isset($style_class)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $data = [
            'name'  =>  $name,
            'intro' =>  $intro,
            'namespace' =>  $namespace,
            'controller_prefix' =>  $controller_prefix,
            'url'   =>  $url,
            'action'    =>  $action,
            'style_class'   =>  $style_class,
            'updated_at'    =>  time(),
        ];
        ActionModel::where('id',$id)->update($data);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '修改成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 由 id 获取记录详情
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
        $actionModel = ActionModel::find($id);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        $datas = $this->objToArr($actionModel);
        $datas['createTime'] = $actionModel->createTime();
        $datas['updateTime'] = $actionModel->updateTime();
        $datas['parentName'] = $actionModel->getParentName();
        $datas['isShow'] = $actionModel->getIsShow();
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
     * 设置记录删除
     */
    public function setIsShow()
    {
        $id = $_POST['id'];
        $isshow = $_POST['isshow'];
        if (!$id || !$isshow) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $actionModel = ActionModel::find($id);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        ActionModel::where('id',$id)->update(['isshow'=> $isshow]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 设置记录是否删除
     */
    public function setDel()
    {
        $id = $_POST['id'];
        $del = $_POST['del'];
        if (!$id || !isset($del)) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $actionModel = ActionModel::find($id);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        ActionModel::where('id',$id)->update(['del'=>$del]);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 销毁记录
     */
    public function forceDelete()
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
        $actionModel = ActionModel::find($id);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        ActionModel::where('id',$id)->delete();
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '销毁成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }

    /**
     * 由 id==pid 查找记录
     */
    public function getActionPidToId()
    {
        $pid = $_POST['pid'];
        if (!$pid) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $actionModel = ActionModel::find($pid);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        $datas = $this->objToArr($actionModel);
        $datas['createTime'] = $actionModel->createTime();
        $datas['updateTime'] = $actionModel->updateTime();
        $datas['parentName'] = $actionModel->getParentName();
        $datas['isShow'] = $actionModel->getIsShow();
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
     * 排序 递增递减
     */
    public function setSort()
    {
        $id = $_POST['id'];
        $sort = $_POST['sort'];
        if (!$id || !$sort) {
            $rstArr = [
                'error' =>  [
                    'code'  =>  -1,
                    'msg'   =>  '参数有误！',
                ],
            ];
            echo json_encode($rstArr);exit;
        }
        $actionModel = ActionModel::find($id);
        if (!$actionModel) {
            if (!$actionModel) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                ];
                echo json_encode($rstArr);exit;
            }
        }
        ActionModel::where('id',$id)->increment('sort', $sort);
        $rstArr = [
            'error' =>  [
                'code'  =>  0,
                'msg'   =>  '操作成功！',
            ],
        ];
        echo json_encode($rstArr);exit;
    }
}