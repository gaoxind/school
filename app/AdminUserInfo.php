<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUserInfo extends Model
{
    public function adminUser(){
        return $this->belongsTo(AdminUser::class);
    }
}
