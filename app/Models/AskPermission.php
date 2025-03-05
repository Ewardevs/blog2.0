<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AskPermission extends Model
{

    protected $fillable = ["file","user_id","reason"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
