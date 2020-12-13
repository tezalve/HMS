<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model{

    use HasFactory;

    public $timestamps = false;
    
    // protected $table = "doctors";

    // protected $casts = [
    //     'consultation_fee' => 'int'
    // ];

    protected $guarded = [
        'bloodgroup',
        'updated_at',
        'created_at'
    ];  

    // protected $fillable = [
    //     'name',
    //     'address',
    //     'email', 
    //     'phone', 
    //     'doctor_status',
    //     'reference_status',
    //     'gender',
    //     'married',
    //     'consultation_fee',
    //     'dob',
    //     'department_id',
    //     'doctor_degree'
    // ];
}