<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    use HasFactory;
    public $table = 'result_models';

    protected $fillable = ['*'];
}
