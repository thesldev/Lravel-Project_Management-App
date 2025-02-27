<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    //

    public function index(){
        return view('calender.index');
    }

    // function for store the event data
    public function store(Request $request){

        $validatedData =  $request->validate([
            'user_id' => 'required|exists:users,id', 
            'title' => 'required|string|max:255',
            'start' => 'required|date|before_or_equal:end',
            'end' => 'required|date|after_or_equal:start',
            'description' => 'nullable|string',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/', 
        ]);

        // Create a new Schedule instance and save the data
        $schedule = new Schedule();
        $schedule->user_id = $validatedData['user_id'];
        $schedule->title = $validatedData['title'];
        $schedule->start = $validatedData['start'];
        $schedule->end = $validatedData['end'];
        $schedule->description = $validatedData['description'] ?? null;
        $schedule->color = $validatedData['color'] ?? '#000000'; // Default to black if no color is provided

        $schedule->save();

        // Redirect back with success message
        return redirect()->route('calender.index')->with('success', 'Event created successfully!');

    }


    // get event details
    public function getEvents()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();
        $schedules = Schedule::where('user_id', $userId)->get();

        if ($schedules->isEmpty()) {
            return response()->json(['message' => 'No events found'], 200);
        }

        return response()->json($schedules);
    }

    // function for update the event data
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'start' => Carbon::parse($request->input('start_date'))->setTimezone('UTC'),
            'end' => Carbon::parse($request->input('end_date'))->setTimezone('UTC'),
        ]);

        return response()->json(['message' => 'Event moved successfully']);
    }


    // function for delete event
    public function deleteEvent($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }


    //function for get selected event data
    public function show($id)
    {
        try {
            $event = Schedule::findOrFail($id);
            return response()->json($event);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Event not found.'], 404);
        }
    }

    // function for resize the event duration
    public function resize(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $newEndDate = Carbon::parse($request->input('end_date'))->setTimezone('UTC');
        $schedule->update(['end' => $newEndDate]);

        return response()->json(['message' => 'Event resized successfully.']);
    }


    // functions for search events 
    public function search(Request $request)
    {
        $searchKeywords = $request->input('title');
        $userId = Auth::id(); 

        // Filter events by title and user ID
        $matchingEvents = Schedule::where('title', 'like', '%' . $searchKeywords . '%')
                                ->where('user_id', $userId)
                                ->get();

        return response()->json($matchingEvents);
    }


}
