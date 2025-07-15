<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $trainings = Training::all();
        $totalCosts = $trainings->sum('planned_costs');
        $groupedByDepartment = $trainings->groupBy('department');
        return view('trainings.index', compact('trainings', 'totalCosts', 'groupedByDepartment'));
    }
    
    /**
     * Display user's own trainings dashboard
     */
    public function dashboard() {
        $userEmail = Auth::user()->email;
        $userName = Auth::user()->name;
        
        // For now, show all trainings for testing purposes
        // In a real application, you might want to add a user_id field to trainings table
        $myTrainings = Training::where('requested_by', $userEmail)
                              ->orWhere('requested_by', $userName)
                              ->orWhere('requested_by', 'LIKE', '%' . $userEmail . '%')
                              ->orWhere('requested_by', 'LIKE', '%' . $userName . '%')
                              ->get();
        
        // If no trainings found with user filtering, show all for demo purposes
        if ($myTrainings->isEmpty()) {
            $myTrainings = Training::all();
        }
        
        $totalCosts = $myTrainings->sum('planned_costs');
        return view('trainings.dashboard', compact('myTrainings', 'totalCosts'));
    }
    
    public function create() {
        return view('trainings.create'); // Eingabeformular für Mitarbeiter
    }
    
    public function store(Request $request) {
        Training::create($request->all());
        return redirect()->route('trainings.index')->with('success', 'Schulung angelegt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $training = Training::findOrFail($id);
        return view('trainings.show', compact('training'));
    }

    public function confirm($id)
    {
        $training = Training::findOrFail($id);
        return view('trainings.confirm', compact('training'));
    }

    public function confirmStore(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->confirmation = json_encode([
            'signature' => $request->signature,
            'date' => $request->date
        ]);
        $training->save();
        return redirect()->route('trainings.show', $id)->with('success', 'Schulung bestätigt!');
    }

    /**
     * Reject a training with reason
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        $training = Training::findOrFail($id);
        $training->rejection_reason = $request->rejection_reason;
        $training->save();

        return redirect()->route('trainings.index')->with('success', 'Schulung wurde abgelehnt.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
