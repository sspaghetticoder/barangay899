<?php

namespace App\Http\Traits;

trait HasCustomUcWords 
{
    public function customUcWords(?string $value = null) 
    {
        if (is_null($value)) return null;

        return ucwords(strtolower($value));
    }
}