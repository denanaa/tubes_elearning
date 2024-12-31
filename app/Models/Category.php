<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nama tabel di database
    protected $primaryKey = 'id_category'; // Primary key tabel

    protected $fillable = ['image', 'name', 'description']; // Sesuaikan dengan kolom tabel categories
}
