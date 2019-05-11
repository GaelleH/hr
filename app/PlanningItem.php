<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;
use App\Absence;
use App\User;

class PlanningItem extends Model
{
    protected $table = 'planning_items';
    protected $fillable = ['absence_id', 'end_date', 'start_date', 'user_id'];
}