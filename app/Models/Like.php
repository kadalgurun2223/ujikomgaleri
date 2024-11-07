<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_contents',
        'id_users',
        'tanggal',
    ];

    // Definisikan relasi dengan pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    // Definisikan relasi dengan konten
    public function content()
    {
        return $this->belongsTo(Content::class, 'id_contents');
    }
}
