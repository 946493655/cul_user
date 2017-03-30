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

    //公司页面布局开关，序列化存储，0关闭，1开启：
    //ppt广告开关，
    //service服务开关，news新闻开关，product产品开关，parterner合作伙伴，intro公司简介，
    //part花絮开关，team团队开关，recruit招聘开关，contact联系开关，footLink底部链接，
    protected $layouts = [
        1=>'service','news','product','parterner','intro','part','team','recruit','contact','footLink','ppt',
    ];
    protected $layoutNames = [
        'service'=>'服务开关','news'=>'新闻开关','product'=>'产品开关','parterner'=>'合作伙伴',
        'intro'=>'公司简介','part'=>'花絮开关','team'=>'团队开关','recruit'=>'招聘开关',
        'contact'=>'联系开关','footLink'=>'底部链接','ppt'=>'广告开关',
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
        return unserialize($this->layout);
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