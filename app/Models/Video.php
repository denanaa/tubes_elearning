<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi Laravel, Anda bisa mendefinisikannya secara eksplisit
    protected $table = 'videos';

    // Jika primary key bukan 'id', Anda bisa mendefinisikannya secara eksplisit
    protected $primaryKey = 'id_video';

    // Jika Anda ingin mengizinkan mass assignment untuk kolom tertentu
    protected $fillable = ['title_video', 'link_video', 'thumbnail_video', 'description_video', 'id_module'];

    // Definisikan relasi jika ada
    public function module()
    {
        return $this->belongsTo(Modul::class, 'id_module', 'id_module');
    }
}