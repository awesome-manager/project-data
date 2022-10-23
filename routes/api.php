<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('check', function () {
        return 'project-data is OK';
    });

    Route::group(['prefix' => 'projects', 'namespace' => 'Project'], function () {
        Route::get('/', [
            'uses' => 'ProjectController@findProjects',
            'as' => 'api.projects.find'
        ]);
        Route::post('/', [
            'uses' => 'ProjectController@createProject',
            'as' => 'api.projects.create'
        ]);
    });

    Route::group(['prefix' => 'statuses', 'namespace' => 'Status'], function () {
        Route::get('/', [
            'uses' => 'StatusController@findStatuses',
            'as' => 'api.statuses.find'
        ]);
    });

    Route::group(['prefix' => 'customers', 'namespace' => 'Customer'], function () {
        Route::get('/', [
            'uses' => 'CustomerController@findCustomers',
            'as' => 'api.customers.find'
        ]);
    });

    Route::group(['prefix' => 'groups', 'namespace' => 'Group'], function () {
        Route::get('/', [
            'uses' => 'GroupController@findGroups',
            'as' => 'api.groups.find'
        ]);
    });
});
