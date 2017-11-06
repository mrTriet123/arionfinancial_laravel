<?php

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