<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Obtiene las tareas que ha creado el usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function misTareas()
    {
        return $this->hasMany(Tarea::class);
    }

    /**
     * Obtiene las tareas relacionadas con el usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    // Nuevo
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'user_id', 'id');
    }

    public function tareasInvitado()
    {
        return $this->belongsToMany(Tarea::class, 'invitaciones', 'user_id', 'tarea_id');
                    //->withPivot('invitado_por_id');
    }

}
