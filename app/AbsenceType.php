<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenceType extends Model
{
    public function scopeSearch($query, $s) {
        return $query->where('name', 'like', '%' .$s. '%');
    }
}
