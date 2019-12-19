<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherContact extends Model
{
    protected $table = "other_contact";
    protected $fillable = [
        'user_id', 'family_type', 'name', 'phone_number', 'type', 'created_at', 'updated_at'
    ];
}
