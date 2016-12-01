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
$app->group(['prefix' => 'api/v1', 'namespace'=>'App\Http\Controllers\Member'], function () use ($app) {
    //用户数据
    $app->post('user', 'UserController@index');
    $app->post('user/oneuser', 'UserController@getOneUser');
    //个人资料
    $app->post('person/one', 'PersonController@getOnePerson');
    //公司资料
    $app->post('company', 'CompanyController@index');
    $app->post('company/one', 'CompanyController@getOneCompany');
    //好友管理
    $app->post('frield/list', 'CompanyController@getFrieldsByUid');
    $app->post('frield/apply', 'CompanyController@getApply');
    $app->post('frield/pass', 'CompanyController@getPass');
    $app->post('frield/refuse', 'CompanyController@getRefuse');
    $app->post('frield/del', 'CompanyController@setDel');
    //签到管理
    //金币管理
});