<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
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
    public function view(User $auth, User $target)
    {
        if ($auth->es_superadmin) return true;
        if ($auth->id === $target->id) return true;

        if ($auth->cargo->descripcion === 'Gerente') {
            return $auth->id_cliente === $target->id_cliente;
        }

        return false;
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
    public function update(User $auth, User $target)
    {
        if ($auth->es_superadmin) return true;

        if ($auth->cargo->descripcion === 'Gerente') {
            return $auth->id_cliente === $target->id_cliente;
        }

        return $auth->id === $target->id; // Cajero: solo él mismo
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $auth, User $target)
    { 
        return $auth->es_superadmin;
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
