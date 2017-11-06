<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;

class DocumentContracts extends Model
{
    protected $table = 'document_contracts';
    protected $fillable = [
        'cash_price', 'fname', 'mname', 'mailling', 
        'p_phone', 'email', 'num_pay', 'fpay', 'lname', 'apt', 'zipcode', 
        'add_phone', 'birthday', 'init_payment', 'file_name', 'user_id',
        'description', 'cost_rental', 'tax_rate', 'payment_amount', 'term_of_pay'
    ];
}
