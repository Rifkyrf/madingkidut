<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'user_id',
        'kategori_id',
        'foto',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}