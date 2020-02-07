<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pago extends Model
{
        use SoftDeletes; //deleted at

    protected $table = 'pago';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['iduser','documento','verificado'];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
}
