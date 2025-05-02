<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDiploma extends Model
{
    use HasFactory;

    // Define los campos que puedes asignar masivamente
    protected $fillable = ['cantidad_generados', 'curso'];
}
