<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi Laravel, Anda bisa mendefinisikannya secara eksplisit
    protected $table = 'categories';

    // Jika primary key bukan 'id', Anda bisa mendefinisikannya secara eksplisit
    protected $primaryKey = 'id_category';

    // Jika Anda ingin mengizinkan mass assignment untuk kolom tertentu
    protected $fillable = ['name_category', 'description'];

    // Definisikan relasi jika ada
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_category', 'id_category');
    }
}