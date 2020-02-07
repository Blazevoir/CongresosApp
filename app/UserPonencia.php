<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserPonencia extends Model
{
    use SoftDeletes; //deleted at

    protected $table = 'userponencia';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['iduser','idponencia'];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function ponencia(){
        return $this->belongsTo('App\Ponencia','idponencia');
    }
    
}
