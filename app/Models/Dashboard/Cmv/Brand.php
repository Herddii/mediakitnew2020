<?php

namespace App\Models\Dashboard\Cmv;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $connection="mysql3";
    protected $table="cmv_brand";

    protected $primaryKey="brand_id";

    public $incrementing=false;

    public function category(){
        return $this->belongsTo('App\Models\Dashboard\Cmv\Category','category_id','category_id')
            ->select(
                [
                    'category_id',
                    'sector_id',
                    'category_name'
                ]
            );
    }

    protected function setPrimaryKey($key)
    {
        $this->primaryKey = $key;
    }

    public function variabel(){
        //return $this->hasMany('App\Models\Dashboard\Cmv\Variabel','brand_id','brand_id');
        
        $relation=$this->belongsToMany('App\Models\Dashboard\Cmv\Subdemography','cmv_variabel','brand_id','subdemo_id','brand_id','subdemo_id')
            ->withPivot('brand_id','subdemo_id','quartal','tahun','totals_thousand','totals_ver','total_hor');

        return $relation;

    }

    public function total(){
        return $this->hasOne('App\Models\Dashboard\Cmv\Variabel','brand_id','brand_id');
    }

}
