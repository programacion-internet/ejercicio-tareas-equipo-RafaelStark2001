<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Notifications\InvitacionTarea;

use App\Http\Controllers\Controller;



class TareaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Tareas propias
        $tareasPropias = $user->tareas()->get();

        // Tareas donde está invitado
        $tareasInvitado = $user->tareasInvitado()->with('invitados')->get();



        return view('tareas.index', compact('tareasPropias', 'tareasInvitado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_limite' => 'required|date',
        ]);

        $user = auth()->user();

        // Crear la tarea y asociarla al usuario
        $tarea = new Tarea();
        $tarea->user_id = $user->id;
        $tarea->nombre = $validated['nombre'];
        $tarea->descripcion = $validated['descripcion'];
        $tarea->fecha_limite = $validated['fecha_limite'];
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        $user = auth()->user();

        if ($user->id !== $tarea->user_id && !$tarea->invitados->contains($user)) {
            abort(403, 'No tienes permiso para ver esta tarea.');
        }

        $usuarios = User::where('id', '!=', $user->id)->get();

        return view('tareas.show', compact('tarea', 'usuarios'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_limite' => 'required|date',
        ]);

        $tarea->update($validated);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }


    // Nuevo

    public function invitar(Request $request, Tarea $tarea)
    {
        // Verifica que el usuario pueda invitar a esta tarea
        $this->authorize('invitar', $tarea);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($tarea->invitados()->where('user_id', $request->user_id)->exists()) {
            return back()->with('error', 'El usuario ya está invitado.');
        }

        $tarea->invitados()->attach($request->user_id);

        // Obtener el usuario y enviar notificación
        $usuarioInvitado = User::find($request->user_id);
        $usuarioInvitado->notify(new InvitacionTarea($tarea));

        return back()->with('success', 'Usuario invitado correctamente.');
    }


}
