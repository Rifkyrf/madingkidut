<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    
    protected $fillable = [
        'artikel_id',
        'user_id',
        'isi'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}