<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFunction extends Model
{
    public function users() {
        return $this->belongsTo(User::class);
    }
}
