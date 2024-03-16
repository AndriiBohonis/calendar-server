<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller

{
    
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $user_id = auth()->id();
          $events = Event::where('user_id', $user_id)->get();

       return  $events;
    }
    public function dayEvents($day){
        $user_id = auth()->id();
        $events = Event::where('user_id', $user_id)
                       ->whereDate('event_date', '=', $day)
                       ->get();
    
        return response()->json($events);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'event_date' => 'required',
            'done' => 'nullable',

        ]);

         $user_id = auth()->id();
         $event = Event::create([
            'description' => $request->description,
            'event_date' => $request->event_date,
            'user_id' => $user_id, 
     ]);
        return $event;
    }

   

     public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'done' => 'required|boolean', 
    ]);

    $event = Event::find($id);
    $event->update(['done' => $validatedData['done']]);
    return $event;
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      return Event::destroy($id);
    }
}
