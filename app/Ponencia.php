<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ponencia extends Model
{
    use SoftDeletes; //deleted at

    protected $table = 'ponencia';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['iduser','titulo','video'];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }

    public function userponencia(){
        return $this->hasMany('App\UserPonencia');
    }
}
