<?php

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

Route::get('/DownloadContract/{ContractID}', 
    array(
        'uses'          =>  'Contract\ContractController@DownloadContract', 
        'as'            =>  'DownloadContract',
    )
);

Route::get('/Add-Contract/{CustomerID}', 
    array(
        'uses'          =>  'Contract\ContractController@AddContract', 
        'as'            =>  'AddContract',
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