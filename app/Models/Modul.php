<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi Laravel, Anda bisa mendefinisikannya secara eksplisit
    protected $table = 'modules';

    // Jika primary key bukan 'id', Anda bisa mendefinisikannya secara eksplisit
    protected $primaryKey = 'id_module';

    // Jika Anda ingin mengizinkan mass assignment untuk kolom tertentu
    protected $fillable = ['name_module'];

    // Definisikan relasi jika ada
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_module', 'id_module');
    }
}