<?php

namespace App\Models\User\Role;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    public $table = 'tblrole';
    public $primaryKey = 'RoleID';
    public $timestamps = false;
    
}