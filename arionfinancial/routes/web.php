<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/Profile', 
    array(
        'uses'          =>  'Account\ProfileController@ViewProfile', 
        'as'            =>  'ViewProfile',
        'middleware'    =>  'auth'
    )
);

Route::get('/Users', 
    array(
        'uses'          =>  'User\UserController@Users', 
        'as'            =>  'Users',
        'middleware'    =>  'auth'
    )
);

Route::get('/User/{ID}', 
    array(
        'uses'          =>  'User\UserController@User', 
        'as'            =>  'User',
        'middleware'    =>  'auth'
    )
);

Route::get('/Add-User', 
    array(
        'uses'          =>  'User\UserController@AddUser', 
        'as'            =>  'AddUser',
        'middleware'    =>  'auth'
    )
);

Route::post('/EditUser', 
    array(
        'uses'          =>  'User\UserController@EditUser', 
        'as'            =>  'EditUser',
        'middleware'    =>  'auth'
    )
);

Route::post('/SaveUser', 
    array(
        'uses'          =>  'User\UserController@SaveUser', 
        'as'            =>  'SaveUser',
        'middleware'    =>  'auth'
    )
);

Route::get('/DeleteUser/{ID}', 
    array(
        'uses'          =>  'User\UserController@UserDelete', 
        'as'            =>  'UserDelete',
        'middleware'    =>  'auth'
    )
);

Route::post('/UpdateProfile', 
    array(
        'uses'          =>  'Account\ProfileController@UpdateProfile', 
        'as'            =>  'UpdateProfile',
        'middleware'    =>  'auth'
    )
);
