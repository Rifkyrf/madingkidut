<?php

namespace App\Policies;

use App\Models\Artikel;
use App\Models\User;

class ArtikelPolicy
{
    public function update(User $user, Artikel $artikel): bool
    {
        // Admin can edit any article
        if ($user->role === 'admin') {
            return true;
        }
        
        // Users can edit their own articles
        if ($user->id === $artikel->user_id) {
            return true;
        }
        
        // Teachers can edit student articles
        if ($user->role === 'guru' && $artikel->user->role === 'siswa') {
            return true;
        }
        
        return false;
    }

    public function delete(User $user, Artikel $artikel): bool
    {
        // Admin can delete any article
        if ($user->role === 'admin') {
            return true;
        }
        
        // Users can delete their own articles
        if ($user->id === $artikel->user_id) {
            return true;
        }
        
        // Teachers can delete student articles
        if ($user->role === 'guru' && $artikel->user->role === 'siswa') {
            return true;
        }
        
        return false;
    }
}
