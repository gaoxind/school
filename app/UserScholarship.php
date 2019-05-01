<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScholarship extends Model
{
   public function user(){
       return $this->belongsTo(User::class);
   }

   public function scholarship(){
       return $this->belongsTo(Scholarship::class);
   }
}
