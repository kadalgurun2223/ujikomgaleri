<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'tanggal',
        'judul',
        'deskripsi',
        'kategori',
        'id_users'
    ];

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_contents');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_contents');
    }
}
