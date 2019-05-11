<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Absence;

class AbsenceType extends Model
{
    public function scopeSearch($query, $s) {
        return $query->where('name', 'like', '%' .$s. '%');
    }

    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
