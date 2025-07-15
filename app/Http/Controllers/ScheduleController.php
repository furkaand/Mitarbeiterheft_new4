<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('Y-m'));
        $startOfMonth = \Carbon\Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endOfMonth = \Carbon\Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $shifts = \App\Models\Shift::whereBetween('date', [$startOfMonth, $endOfMonth])->with('user')->get();
        $users = \App\Models\User::all();
        $weeks = $this->prepareWeeks($startOfMonth, $endOfMonth);

        // Monatsname und Jahr für Anzeige (z.B. "05 Mai 2025")
        $monthName = $startOfMonth->locale('de')->isoFormat('MM MMMM YYYY');

        // Dropdown: Liste der letzten 12 Monate inkl. aktueller Monat
        $months = collect();
        $current = Carbon::now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $months->push([
                'value' => $current->format('Y-m'),
                'label' => $current->locale('de')->isoFormat('MM MMMM YYYY')
            ]);
            $current->subMonth();
        }
        $months = $months->reverse()->values();

        return view('schedule.index', compact('shifts', 'users', 'weeks', 'month', 'monthName', 'months'));
    }

    public function manage()
    {
        $shifts = Shift::with('user')->get();
        $users = User::all();
        $weeks = $this->prepareWeeks();

        return view('schedule.manage', compact('shifts', 'users', 'weeks'));
    }

    public function create()
    {
        $users = User::all();
        return view('schedule.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'shift_type' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Shift::create($request->all());

        return redirect()->route('schedule.manage')->with('success', 'Shift successfully created');
    }

    private function prepareWeeks($start = null, $end = null)
    {
        $weeks = [];
        $startDate = $start ? $start->copy()->startOfWeek() : \Carbon\Carbon::now()->startOfWeek();
        $endDate = $end ? $end->copy()->endOfWeek() : \Carbon\Carbon::now()->addWeeks(4)->endOfWeek();

        while ($startDate->lte($endDate)) {
            $week = [
                'kw' => 'KW ' . $startDate->weekOfYear,
                'days' => []
            ];

            for ($i = 0; $i < 7; $i++) {
                $day = $startDate->copy()->addDays($i);
                $week['days'][] = [
                    'date' => $day->format('Y-m-d'),
                    'day' => substr($day->locale('de')->dayName, 0, 2),
                    'month' => $day->locale('de')->monthName
                ];
            }

            $weeks[] = $week;
            $startDate->addWeek();
        }

        return $weeks;
    }
}
