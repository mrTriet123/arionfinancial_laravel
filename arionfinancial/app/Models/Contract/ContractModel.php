<?php

namespace App\Models\Contract;

use Illuminate\Database\Eloquent\Model;

class ContractModel extends Model
{
    public $table = 'tblcontract';
    public $primaryKey = 'ContractID';
    public $timestamps = true;
    
    public function Customer() {
        return $this->hasOne('App\Models\User\UserModel', 'UserID','CustomerID');
    }
    
    public function Payments() {
        return $this->hasMany("App\Models\Contract\Payment\PaymentModel", "ContractID", "ContractID");
    }
}