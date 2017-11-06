<?php

namespace App\Models\Contract\Payment;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    public $table = 'tblpayment';
    public $primaryKey = 'PaymentID';
    public $timestamps = true;
    
    public function Contract() {
        return $this->hasOne("App\Models\Contract\ContractModel", "ContractID", "ContractID");
    }
    
    public function PaymentSource() {
        return $this->belongsTo("App\Models\Contract\Payment\Source\PaymentSourceModel", "PaymentSourceID", "");
    }
}