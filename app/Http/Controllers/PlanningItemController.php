<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanningItem;
use App\User;
use DB;
use Carbon\Carbon;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class PlanningItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = PlanningItem::all();
        $event = [];
        foreach($events as $row) {
            $endDate = $row->end_date." 24:00:00";
            $user = User::find($row->user_id);
            $event[] = \Calendar::event(
                'Verlof '. $user->first_name,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => '#1DC7EA',
                    'editable' => false,
                ]
            );
        }

        $calendar = \Calendar::addEvents($event)
            ->setOptions([
                'allDaySlot' => false,
                'navLinks' => true,
                'nowIndicator' => true,
                'defaultView' => 'agendaWeek',
                'minTime' => '07:00:00',
                'maxTime' => '21:00:00',
            ])
            ->setCallbacks([
                // 'eventClick' => 'function(info) {
                //     console.log(info);
                //     swal("info.title","","success");
                // }'
            ]);
        return view('planningItems.index', compact('events', 'calendar'));
    }
}
