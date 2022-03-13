<?php

namespace App\Http\Traits;

trait HasCustomUcWords 
{
    public function customUcWords(string $value = '') : string 
    {
        return ucwords(strtolower($value));
    }
}