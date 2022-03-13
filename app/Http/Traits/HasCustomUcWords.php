<?php

namespace App\Http\Traits;

trait HasCustomUcWords 
{
    public function customUcWords(?string $value = null) : string 
    {
        return ucwords(strtolower($value));
    }
}