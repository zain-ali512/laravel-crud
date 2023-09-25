<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    public $timestamps = false;
    protected $primaryKey = 'emp_id';
    protected $fillable = [
        'emp_id',
        'f_name',
        'l_name',     
        'designation'
    ];
}