<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    /** @use HasFactory<\Database\Factories\TareaFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'fecha_limite',
    ];

    protected $casts = [
        'fecha_limite' => 'date',
    ];

    /**
     * Tareas que pertenecen al usuario.
     *
     * @return void
     */

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'tarea_user', 'tarea_id', 'user_id');
    }

    //Nuevo
    public function invitados()
    {
        return $this->belongsToMany(User::class, 'invitaciones', 'tarea_id', 'user_id');
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

}
