<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    
    
    public $table = 'tbluser';
    public $primaryKey = 'UserID';
    public $timestamps = true;
    
    protected $casts = [
        'IsActive' => 'boolean',
    ];
    
    public function WhoCreatedTheUser() {
        return $this->hasOne('App\Models\User\UserModel', 'UserID', 'WhoCreated');
    }
    
    public function Role() {
        return $this->hasOne("App\Models\User\Role\RoleModel", "RoleID", "RoleID");
    }
}