<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Spatial;

class Person extends Model
{
    use HasFactory, SoftDeletes, Spatial;
    protected $dates = ['deleted_at'];
    protected $spatial = ['ubicacion'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
