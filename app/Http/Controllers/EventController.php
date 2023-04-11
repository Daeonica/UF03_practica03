<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEventsAttendee;




class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(3);
        return view('events.events', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required'
        ]);

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->user_id = Auth::id(); // Asignar el user_id del usuario loggeado
        $event->save();

        return redirect()->route('events.events');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id = null)
    {
        $search = $request->input('search');

        $event = Event::query()
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->with('attendees')
            ->first();

        return view('events.show', compact('event'));
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required', // Validación para el campo location

        ]);

        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location'); // Asignar el valor del campo location al modelo
        $event->save();

        return redirect()->route('events.events');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.events');
    }

    public function register($id)
    {
        // Obtener el evento con el ID proporcionado
        $event = Event::find($id);

        return view('events.register', compact('event'));
    }

    public function storeAttendee(Request $request, $id)
    {
        // Validar los datos del formulario de registro de asistente
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Obtener el evento al que se desea registrar el asistente
        $event = Event::findOrFail($id);

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Crear el nuevo usuario_evento_asistente
        $userEventAttendee = new UserEventsAttendee();
        $userEventAttendee->name = $validatedData['name'];
        $userEventAttendee->email = $validatedData['email'];
        $userEventAttendee->user_id = $user->id;
        $userEventAttendee->event_id = $event->id;
        $userEventAttendee->save();

        // Redireccionar al usuario a la página del evento
        return redirect()->route('events.events');
    }
    public function showAttendees($id)
    {
        $event = Event::with('attendees')->findOrFail($id);

        $attendees = $event->attendees;

        return view('events.showAttendees', [
            'event' => $event,
            'attendees' => $attendees
        ]);
    }
    public function destroyAttendee($eventId, $attendeeId)
    {
        $event = Event::findOrFail($eventId);
        $attendee = UserEventsAttendee::where('event_id', $eventId)->where('id', $attendeeId)->firstOrFail();
        $attendee->delete();
        return redirect()->route('events.showAttendees', $event->id);
    }
}
