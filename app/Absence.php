<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AbsencesYear;
use App\AbsenceType;

class Absence extends Model
{
    public function scopeSearch($query, $s) {
        return $query->where('first_name', 'like', '%' .$s. '%')
        ->orWhere('last_name', 'like', '%' .$s. '%')
        ->orWhere('year', 'like', '%' .$s. '%')
        ->orWhere('name', 'like', '%' .$s. '%');
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    // public function absenceDates() {
    //     return $this->belongsToMany(AbsencesYear::class);
    // }

    // public function absenceTypes() {
    //     return $this->belongsTo(AbsenceType::class);
    // }
}
