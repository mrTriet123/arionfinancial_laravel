<?php

namespace App\Models\Contract\Payment\Source;

use Illuminate\Database\Eloquent\Model;

class PaymentSourceModel extends Model
{
    public $table = 'tblpaymentsource';
    public $primaryKey = 'PaymentSourceID';
    public $timestamps = false;
}