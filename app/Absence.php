<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AbsenceType;
use App\AbsencesYear;
use App\AbsenceDate;

class Absence extends Model
{
    public function scopeSearch($query, $s) {
        return $query->where('first_name', 'like', '%' .$s. '%')
        ->orWhere('last_name', 'like', '%' .$s. '%')
        ->orWhere('year', 'like', '%' .$s. '%')
        ->orWhere('name', 'like', '%' .$s. '%');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function absenceDates() {
        return $this->hasMany(AbsenceDate::class);
    }

    public function absenceType() {
        return $this->belongsTo(AbsenceType::class);
    }

    public function absencesYear() {
        return $this->belongsTo(AbsencesYear::class);
    }
}
