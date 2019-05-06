<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScholarship extends Model
{
    protected $fillable = ['user_id', 'scholarship_id','required_course','required_course'];

   public function user(){
       return $this->belongsTo(User::class);
   }

   public function scholarship(){
       return $this->belongsTo(Scholarship::class);
   }
}
