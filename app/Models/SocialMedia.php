<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable=['post'];
    use HasFactory;

    public function post(){
        return $this->belongsTo(User::class,'user_id');
      }
}
