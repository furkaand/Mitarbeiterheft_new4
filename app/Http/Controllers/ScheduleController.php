<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Employee;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $shifts = Shift::with('employee')->get();
        $employees = Employee::all();
        $weeks = $this->prepareWeeks();

        return view('schedule.index', compact('shifts', 'employees', 'weeks'));
    }

    public function manage()
    {
        $shifts = Shift::with('employee')->get();
        $employees = Employee::all();
        $weeks = $this->prepareWeeks();

        return view('schedule.manage', compact('shifts', 'employees', 'weeks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('schedule.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date',
            'shift_type' => 'nullable|string',
            'employee_id' => 'required|exists:employees,id',
        ]);

        Shift::create($request->all());

        return redirect()->route('schedule.manage')->with('success', 'Shift successfully created');
    }

    private function prepareWeeks()
    {
        $weeks = [];
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->addWeeks(4)->endOfWeek();

        while ($startDate->lte($endDate)) {
            $week = [
                'kw' => 'KW ' . $startDate->weekOfYear,
                'days' => []
            ];

            for ($i = 0; $i < 7; $i++) {
                $day = $startDate->copy()->addDays($i);
                $week['days'][] = [
                    'date' => $day->format('d'),
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
