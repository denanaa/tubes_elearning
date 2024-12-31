<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $table = 'videos'; // Nama tabel
    protected $primaryKey = 'id_video'; // Primary key

    protected $fillable = [
        'id_module', // Foreign Key
        'name_module',
        'title_video', 
        'link_video', 
        'thumbnail_video', 
        'description_video',
    ];

     // Relasi ke tabel 'modules'
     public function module()
     {
         return $this->belongsTo(Modul::class, 'id_module', 'id_module');
     }
}
