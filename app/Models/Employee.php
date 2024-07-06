<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'profile_pic', 'mobile_number', 'parents_name', 'current_address', 'parmanent_address', 'adhar_number', 'date_of_birth', 'gender', 'emergency_contact_no', 'email', 'age', 'roles_id', 'highest_qualification'];

}
