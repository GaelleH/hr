<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AbsencesYear;
use App\AbsenceType;
use App\Absence;

class AbsenceDate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'number_of_hours', 'absence_id'
    ];

    public function absence() {
        return $this->belongsTo(Absence::class);
    }
}
