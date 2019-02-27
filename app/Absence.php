<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AbsencesYear;
use App\AbsenceType;

class Absence extends Model
{
    public function users() {
        return $this->belongsTo(User::class);
    }

    // public function absenceYears() {
    //     return $this->belongsTo(AbsencesYear::class);
    // }

    // public function absenceTypes() {
    //     return $this->belongsTo(AbsenceType::class);
    // }
}
