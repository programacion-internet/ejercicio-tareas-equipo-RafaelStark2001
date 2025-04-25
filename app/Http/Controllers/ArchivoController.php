<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Archivo;
use App\Models\Tarea;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:5120',
            'tarea_id' => 'required|exists:tareas,id',
        ]);

        $archivoSubido = $request->file('archivo');
        $ruta = $archivoSubido->store('archivos', 'public');

        Archivo::create([
            'tarea_id' => $request->tarea_id,
            'nombre_original' => $archivoSubido->getClientOriginalName(),
            'ruta' => $ruta,
        ]);

        return back()->with('success', 'Archivo subido correctamente.');
    }

    public function destroy(Archivo $archivo)
    {
        $this->authorize('delete', $archivo); // Usa policy si es necesario

        Storage::delete('public/' . $archivo->ruta);
        $archivo->delete();

        return back()->with('success', 'Archivo eliminado.');
    }

}
