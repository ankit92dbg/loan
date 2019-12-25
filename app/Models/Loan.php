<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = "loan";
    protected $fillable = [
        'loan_amount','requested_amount','eligible_amount','interest_rate','processing_fee','gst','loan_duration','loan_purpose','loan_status'    
    ];
}
