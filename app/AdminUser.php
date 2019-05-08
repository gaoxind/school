<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    public function AdminUserRole(){
        return $this->hasOne(AdminRoleUser::class,'user_id','id');
    }
}
