<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model (modules)
    protected $table = 'modules'; 
    protected $primaryKey = 'id_module'; // Nama primary key (sesuaikan jika berbeda)
    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_category',
        'name_module',
        'name',
    ];

    /**
     * Relasi ke model Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    // public function videos()
    // {
    //     return $this->hasMany(Video::class, 'id_module', 'id_module'); 
    // }
}
