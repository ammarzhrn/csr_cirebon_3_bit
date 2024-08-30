<?php

namespace App\Policies;

use App\Models\Proyek;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProyekPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa melihat daftar proyek
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Proyek $proyek): bool
    {
        return true; // Semua user bisa melihat detail proyek
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->level === 'admin'; // Hanya admin yang bisa membuat proyek
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Proyek $proyek): bool
    {
        return $user->level === 'admin'; // Hanya admin yang bisa mengupdate proyek
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Proyek $proyek): bool
    {
        return $user->level === 'admin'; // Hanya admin yang bisa menghapus proyek
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Proyek $proyek): bool
    {
        return $user->level === 'admin'; // Hanya admin yang bisa memulihkan proyek
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Proyek $proyek): bool
    {
        return $user->level === 'admin'; // Hanya admin yang bisa menghapus permanen proyek
    }
}
