<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


/**
 * get请求，返回数据
 */
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Member'], function () use ($app) {
    $app->get('user', 'UserController@index');
});


/**
 * 接口的post请求，返回数据
 */
//用户管理
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Member'], function () use ($app) {
    //用户数据
    $app->post('user', 'UserController@index');
    $app->post('user/oneuser', 'UserController@getOneUser');
    $app->post('user/oneuserbyuname', 'UserController@getOneUserByUname');
    $app->post('user/doregist', 'UserController@doRegist');
    $app->post('user/dologin', 'UserController@doLogin');
    $app->post('user/dologout', 'UserController@doLogout');
    $app->post('user/modify', 'UserController@update');
    $app->post('user/getusersbytime', 'UserController@getUsersByTime');
    $app->post('user/auth', 'UserController@setAuth');
    //用户参数
    $app->post('user/userparam', 'UserController@getUserParamByUid');
    //个人资料
    $app->post('person/one', 'PersonController@getOnePerson');
    $app->post('person/add', 'PersonController@store');
    //公司资料
    $app->post('company', 'CompanyController@index');
    $app->post('company/one', 'CompanyController@getOneCompany');
    $app->post('company/add', 'CompanyController@store');
    $app->post('company/show', 'CompanyController@show');
    //好友管理
    $app->post('frield/list', 'CompanyController@getFrieldsByUid');
    $app->post('frield/apply', 'CompanyController@getApply');
    $app->post('frield/pass', 'CompanyController@getPass');
    $app->post('frield/refuse', 'CompanyController@getRefuse');
    $app->post('frield/del', 'CompanyController@setDel');
    //用户心声
    $app->post('uservoice', 'UserVoiceController@index');
    $app->post('uservoice/add', 'UserVoiceController@store');
    $app->post('uservoice/modify', 'UserVoiceController@update');
    $app->post('uservoice/show', 'UserVoiceController@show');
    //用户意见
    $app->post('opinion', 'OpinionController@index');
    $app->post('opinion/add', 'OpinionController@store');
    $app->post('opinion/modify', 'OpinionController@update');
    $app->post('opinion/show', 'OpinionController@show');
    $app->post('opinion/isdel', 'OpinionController@setDel');
    $app->post('opinion/delete', 'OpinionController@forceDelete');
});

//活动管理
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Activity'], function () use ($app) {
    //签到管理
    $app->post('sign', 'SignController@index');
    $app->post('sign/add', 'SignController@store');
    //金币管理
    $app->post('gold', 'SignController@index');
    $app->post('gold/add', 'SignController@store');
});

//管理员管理
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Admin'], function () use ($app) {
    //日志管理
    $app->post('log', 'LogController@index');
    $app->post('log/add', 'LogController@store');
    $app->post('log/logout', 'LogController@logout');
    $app->post('log/getlogsbytime', 'LogController@getLogsByTime');
    $app->post('log/show', 'LogController@show');
    //管理员管理
    $app->post('admin', 'AdminController@index');
    $app->post('admin/one', 'AdminController@getOneAdmin');
    $app->post('admin/getonebyuname', 'AdminController@getOneAdminByUname');
    $app->post('admin/add', 'AdminController@store');
    $app->post('admin/modify', 'AdminController@update');
    $app->post('admin/delete', 'AdminController@delete');
    //管理员角色
    $app->post('role', 'RoleController@index');
    $app->post('role/all', 'RoleController@all');
    $app->post('role/add', 'RoleController@store');
    $app->post('role/modify', 'RoleController@update');
    $app->post('role/show', 'RoleController@show');
    $app->post('role/delete', 'RoleController@forceDelete');
    $app->post('role/roleaction', 'RoleController@setRoleAction');
    //管理员角色
    $app->post('action', 'ActionController@index');
    $app->post('action/add', 'ActionController@store');
    $app->post('action/modify', 'ActionController@update');
    $app->post('action/show', 'ActionController@show');
    $app->post('action/isshow', 'ActionController@setIsShow');
    $app->post('action/isdel', 'ActionController@setDel');
    $app->post('action/delete', 'ActionController@forceDelete');
    $app->post('action/adminmenus', 'ActionController@getAdminMenus');
    $app->post('action/getactionsbypid', 'ActionController@getActionsByPid');
    $app->post('action/getactionpidtoid', 'ActionController@getActionPidToId');
    $app->post('action/sort', 'ActionController@setSort');
    $app->post('action/all', 'ActionController@actionAll');
});