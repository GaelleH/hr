<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsencesYear extends Model
{
    public function scopeSearch($query, $s) {
        return $query->where('year', 'like', '%' .$s. '%');
        // ->orWhere('first_name', 'like', '%' .$s. '%');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function absence() {
        return $this->belongsTo(Absence::class);
    }
}
