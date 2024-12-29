<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model (modules)
    protected $table = 'modules'; 

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_category',
        'name_module',
    ];

    /**
     * Relasi ke model Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
