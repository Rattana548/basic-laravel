<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'department_name',
    ];

    function user(){
        return $this->hasOne(User::class,'id','department_id');
    }
}
