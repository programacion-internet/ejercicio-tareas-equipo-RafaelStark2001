<?php

namespace App\Policies;

//namespace Database\Factories;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Auth\Access\HandlesAuthorization;

class TareaPolicy
{

    protected $model = Tarea::class;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tarea $tarea)
    {
        // El usuario puede ver si es el dueño o está invitado
        return $tarea->user_id === $user->id || $tarea->invitados->contains($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tarea $tarea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tarea $tarea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tarea $tarea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tarea $tarea): bool
    {
        return false;
    }

    //Nuevo

    public function invitar(User $user, Tarea $tarea)
    {
        // Solo el propietario de la tarea puede invitar a otros usuarios
        return $user->id === $tarea->user_id
            ? Response::allow()
            : Response::deny('No tienes permisos para invitar usuarios a esta tarea.');
    }

}
