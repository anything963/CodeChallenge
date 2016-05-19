<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Hour extends Model
{
    //
    protected $fillable = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
