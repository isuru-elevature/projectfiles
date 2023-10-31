<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DataSourceType;
class DataSource extends Model
{
    use HasFactory,softDeletes;

    public $table = 'data_sources';

    protected $fillable = [
        'name','data_source_type','created_by'
    ];

    public function getDataSourceType(){

        return $this->hasmany(DataSourceType::class, 'dataSourceType', 'data_source_type');
    }
}
