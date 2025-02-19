<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Employee;

class ScheduleController extends Controller
{
    public function index()
    {
        $shifts = Shift::with('employee')->get();
        return view('schedule.index', compact('shifts'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('schedule.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'shift_type' => 'required|string',
            'employee_id' => 'required|exists:employees,id',
        ]);

        Shift::create($request->all());

        return redirect()->route('schedule.index')->with('success', 'Shift successfully created');
    }
}
