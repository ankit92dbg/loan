<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'first_name', 'last_name', 'email','phone','father_name','dob','gender','martial_status','aadhar_no','aadhar_front','aadhar_back','pan_no','pan_front','video','bank_name','bank_account_no','bank_ifsc','loan_purpose','residential_status','permanent_address','company_name','salary','loan_amount','interest_rate','processing_fee','gst','loan_duration','profile_status','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
