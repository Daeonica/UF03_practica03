<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEventsAttendee;

class EventController extends Controller
{

    public function index()
    //Muestra los eventos del usuario loggeado
    {
        $user = auth()->user(); //Obtiene el usuario actualmente autenticado en la aplicación
        $events = Event::where('user_id', $user->id)->paginate(6);
        return view('events.events', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    //Insertamos Evento en la bbdd
    {
        // Validamos los campos del formulario
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required'
        ]);
        // Creamos una nueva instancia de Event
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->user_id = Auth::id(); //Asignar el user_id del usuario loggeado
        $event->save(); //Guardamos $event en la base de datos

        return redirect()->route('events.events');
    }

    public function show(Request $request, $id = null)
    {
        $search = $request->input('search');
        //La busqueda se realiza a partir de la query o a partir del id (si se pasa)
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

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }


    public function update(Request $request, Event $event)
    //Se actualiza el evento que pasamos por parametro con los datos que pasamos por parametro
    {
        //Validamos los datos y los guardamos
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'date' => 'required|date|after_or_equal:2023-04-01',
            'location' => 'required|max:255',
        ]);

        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->save();

        return redirect()->route('events.events');
    }


    public function destroy(Event $event)
    //Se elimina el evento de la bbdd
    {
        //Se elimina evento
        $event->delete();

        return redirect()->route('events.events');
    }

    public function register($id)
    //Vamos a una página para añadir usuarios al evento
    {
        // Obtener el evento con el Id de parametro
        $event = Event::find($id);

        return view('events.register', compact('event'));
    }

    public function storeAttendee(Request $request, $id)
    //Añadimos un Attendee 
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        //Obtenemos el evento al que se desea registrar el asistente
        $event = Event::findOrFail($id);

        //Obtenenemos el usuario que esta loggeado
        $user = auth()->user();

        $userEventAttendee = new UserEventsAttendee();
        $userEventAttendee->name = $validatedData['name'];
        $userEventAttendee->email = $validatedData['email'];
        //el id del usuario loggeado, que es el que ha creado el evento
        $userEventAttendee->user_id = $user->id;
        //el id del evento al que el Attendee va a asistir
        $userEventAttendee->event_id = $event->id;
        $userEventAttendee->save();

        return redirect()->route('events.events');
    }

    public function showAttendees($id)
    //Muestra los Attendees
    {
        $event = Event::with('attendees')->findOrFail($id);

        $attendees = $event->attendees;

        return view('events.showAttendees', [
            'event' => $event,
            'attendees' => $attendees
        ]);
    }

    public function destroyAttendee($eventId, $attendeeId)
    //Se elimina Attendee
    {
        $event = Event::findOrFail($eventId);
        $attendee = UserEventsAttendee::where('event_id', $eventId)->where('id', $attendeeId)->firstOrFail();
        $attendee->delete();
        return redirect()->route('events.showAttendees', $event->id);
    }
}
