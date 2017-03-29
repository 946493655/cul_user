<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'user_companys';
    protected $fillable = [
        'id','name','genre','area','point','address','yyzzid','uid','areacode','tel','qq','web','fax','zipcode','email','logo','skin','layout','sort','created_at','updated_at',
    ];

    //公司页面布局开关，0关闭，1开启：
    //serviceSwitch服务开关，newsSwitch新闻开关，productSwitch产品开关，parternerSwitch合作伙伴，introSwitch公司简介，
    //partSwitch花絮开关，teamSwitch团队开关，recruitSwitch招聘开关，contactSwicth类型开关，footLinkSwitch底部链接，
    protected $layoutNames = [
        1=>'服务开关','新闻开关','产品开关','合作伙伴','公司简介','花絮开关','团队开关','招聘开关','类型开关','底部链接',
    ];

    /**
     *  3普通企业，5广告公司，6影视公司，7租赁公司
     */
    protected $genres = [
        3=>'普通企业',5=>'广告公司','影视公司','租赁公司',
    ];

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getLayoutArr()
    {
        if (!$this->layout) { return array(); }
        $layouts = explode(',',$this->layout);
        $layoutArr = array();
        foreach ($layouts as $k=>$layout) {
            $layoutName = $this->layoutNames[$k+1].'：';
            $switch = $layout ? '开' : '关';
            $layoutName .= $layoutName.$switch.'；';
            $layoutArr[] = $layoutName;
        }
        return $layoutArr;
    }

    /**
     * 获取地图定位坐标
     */
    public function getPoint()
    {
        return $this->point ? explode(',',$this->point) : [];

    }

    /**
     * 获取地图定位坐标 X
     */
    public function getPointX()
    {
        return $this->getPoint() ? $this->getPoint()[0] : '120';

    }

    /**
     * 获取地图定位坐标 Y
     */
    public function getPointY()
    {
        return $this->getPoint() ? $this->getPoint()[1] : '30';

    }
}