<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/resend/{email}', 'User\UserController@resend');

Route::post('postlogin','Account\ProfileController@postlogin');

Route::get('/Activate/{credentials}', 'User\UserController@activate');

Route::post('/logout/', 'User\UserController@logout');

Route::get('PDF/{DATA}','User\UserController@PDF');

Route::post('/UpdateProfile', 
    array(
        'uses'          =>  'Account\ProfileController@UpdateProfile', 
        'as'            =>  'UpdateProfile',
    )
);

Route::get('/Profile', 
    array(
        'uses'          =>  'Account\ProfileController@ViewProfile', 
        'as'            =>  'ViewProfile',
    )
);

Route::post('/reset', 'User\UserController@resetpass');



Route::get('/reset', function(){
 return view('User/resetpass');
});

Route::get('/resetpass/{credentials}', 'User\UserController@resetpass_email');

Route::group(['middleware' => 'SuperAdmin'],function(){
    Route::get('/Users', [
        'uses'          =>  'User\UserController@Users', 
        'as'            =>  'Users', 
    ]);
});

Route::group(['middleware' => 'Customer'],function(){

    Route::get('/account-details', 
        array(
            'uses'          =>  'Account\AccountController@detailsAccount', 
            'as'            =>  'detailsAccount',
        )
    );

    Route::get('/Add-User', 
        array(
            'uses'          =>  'User\UserController@AddUser', 
            'as'            =>  'AddUser',
        )
    );

    Route::get('/Statements/', 
        array(
            'uses'          =>  'User\UserController@Statments', 
            'as'            =>  'Statments',
        )
    );

    Route::post('/Statements/', 
        array(
            'uses'          =>  'User\UserController@Statments', 
            'as'            =>  'Statments',
        )
    );

    Route::get('/get-statements/', 
        array(
            'uses'          =>  'User\UserController@getStatments', 
            'as'            =>  'Statments',
        )
    );

    Route::post('/post-statements/', 
        array(
            'uses'          =>  'User\UserController@postStatments', 
            'as'            =>  'Statments',
        )
    );

    Route::get('/Detail-Statement/{ID}/{Date}', 
        array(
            'uses'          =>  'User\UserController@DetailStatment', 
            'as'            =>  'Statments-Date',
        )
    );

    Route::get('/Account', 
        array(
            'uses'          =>  'User\UserController@getAccount', 
            'as'            =>  'getAccounts',
        )
    );

    Route::post('/Account', 
        array(
            'uses'          =>  'User\UserController@postAccount', 
            'as'            =>  'postAccounts',
        )
    );

    Route::get('view-accounts','User\UserController@getViewAccount');

    Route::post('view-accounts','User\UserController@postViewAccount');
});
Route::get('/User/{ID}', 
    array(
        'uses'          =>  'User\UserController@User', 
        'as'            =>  'User',
    )
);


Route::get('/Add-User', 
    array(
        'uses'          =>  'User\UserController@AddUser', 
        'as'            =>  'AddUser',
    )
);

Route::post('/EditUser', 
    array(
        'uses'          =>  'User\UserController@EditUser', 
        'as'            =>  'EditUser',
    )
);

Route::post('/SaveUser', 
    array(
        'uses'          =>  'User\UserController@SaveUser', 
        'as'            =>  'SaveUser',
    )
);

Route::get('/DeleteUser/{ID}', 
    array(
        'uses'          =>  'User\UserController@UserDelete', 
        'as'            =>  'UserDelete',
    )
);


Route::group(['middleware' => 'Dealer'],function(){


Route::get('/Contracts/{CustomerID}', 
    array(
        'uses'          =>  'Contract\ContractController@Contracts', 
        'as'            =>  'Contracts',
    )
);

Route::get('/Contract/{ContractID}', 
    array(
        'uses'          =>  'Contract\ContractController@Contract', 
        'as'            =>  'Contract',
    )
);

Route::post('/DownloadContract/', 
    array(
        'uses'          =>  'Contract\ContractController@DownloadContract', 
        'as'            =>  'DownloadContract',
    )
);

Route::get('/EmailContract/{ContractID}', 
    array(
        'uses'          =>  'Contract\ContractController@EmailContract', 
        'as'            =>  'EmailContract',
    )
);

Route::get('/Add-Contract/{CustomerID}', 
    array(
        'uses'          =>  'Contract\ContractController@AddContract', 
        'as'            =>  'AddContract',
    )
);
Route::get('add-leasing/{CustomerID}', 
    array(
        'uses'          =>  'Contract\ContractController@addLeasing', 
        'as'            =>  'addleasing',
    )
);
Route::get('add-financing/{CustomerID}', 
    array(
        'uses'          =>  'Contract\ContractController@addFinancing', 
        'as'            =>  'addfinancing',
    )
);

Route::post('/EditContract', 
    array(
        'uses'          =>  'Contract\ContractController@EditContract', 
        'as'            =>  'EditContract',
    )
);

Route::post('/SaveContract', 
    array(
        'uses'          =>  'Contract\ContractController@SaveContract', 
        'as'            =>  'SaveContract',
    )
);

Route::get('/ContractDelete/{ID}', 
    array(
        'uses'          =>  'Contract\ContractController@ContractDelete', 
        'as'            =>  'ContractDelete',
    )
);


//////////////////////////////////////////////////PAYMENTS/////////////////////////////////////////////

Route::get('/Payments/{ContractID}', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@Payments', 
        'as'            =>  'Payments',
    )
);

Route::get('/Payment/{PaymentID}', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@Payment', 
        'as'            =>  'Payment',
    )
);

Route::get('/Add-Payment/{ContractID}', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@AddPayment', 
        'as'            =>  'AddPayment',
    )
);

Route::post('/SavePayment', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@SavePayment', 
        'as'            =>  'SavePayment',
    )
);

Route::post('/EditPayment', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@EditPayment', 
        'as'            =>  'EditPayment',
    )
);

Route::delete('/Payments/{ContractID}', 
    array(
        'uses'          =>  'Contract\Payment\PaymentController@deletePayments', 
        'as'            =>  'deletePayments',
    )
);
});
Route::group(['middleware' => 'FilterDearler', 'namespace' => 'Document'],function(){
    Route::get('/leasing', 'DocumentController@indexLeasing')->name('contract-leasing');
    Route::get('/financial', 'DocumentController@indexFinancial');
    Route::post('/contract-infor', 'DocumentController@storeInformation')->name('contract-infor');
    Route::get('/lists-contract', 'DocumentController@listContract')->name('lists-contract');
    Route::get('/documents', 'DocumentController@viewPdf')->name('view-pdf');
});

Route::get('migrate', function () {
    try{
        $exitCode = Artisan::call('migrate');
        echo 'Status:' . $exitCode;
    }catch(\Exception $e){
        echo $e->getMessage();
    }
});

Route::get('migrate/rollback', function () {
    try{
        $exitCode = Artisan::call('migrate:rollback');
        echo 'Status:' . $exitCode;
    }catch(\Exception $e){
        echo $e->getMessage();
    }
});

Route::get('/static', function () {
    return view('static.first');
});

//////////////////////////////////////////////////////////////CONTRACT////////////////////////////////////////////////////////