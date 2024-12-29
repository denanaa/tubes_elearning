<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model (categories)
    protected $table = 'categories'; // Nama tabel
    protected $primaryKey = 'id_category'; // Primary key
    public $incrementing = true; // Primary key auto-increment
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable = [
        'image_category',
        'name_category',
        'description_category',
    ]; // Kolom yang bisa diisi

    /**
     * Relasi ke modul
     */
    public function moduls()
    {
        return $this->hasMany(Modul::class, 'id_category', 'id_category');
    }
}
