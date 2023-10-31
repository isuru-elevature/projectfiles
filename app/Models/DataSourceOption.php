<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSourceOption extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'data_source_options';

    protected $fillable = ['*'];
}
