<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Congreso extends Model
{
    use SoftDeletes; //deleted at

    protected $table = 'congreso';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['titulo','descripcion','precio'];
}
