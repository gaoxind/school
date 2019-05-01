<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_all extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function userInfo(){
        return $this->belongsTo(UserInfo::class,'user_id','user_id');
    }
}
