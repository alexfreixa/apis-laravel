<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Image;

class ValidImageIdRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Comprueba si el valor es nulo
        if (is_null($value)) {
            return true;
        }
        
        // Comprueba si el ID de la imagen existe en la base de datos
        return Image::where('id', $value)->exists();
    }

    public function message()
    {
        return 'El campo :attribute debe ser un ID de imagen existente.';
    }
}