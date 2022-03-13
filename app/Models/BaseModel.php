<?php

namespace App\Models;

use App\Http\Traits\HasCustomUcWords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasCustomUcWords;
    use HasFactory;

    protected function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $this->customUcWords($value);
    }

    protected function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $this->customUcWords($value);
    }

    protected function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = $this->customUcWords($value);
    }

    protected function setSuffixAttribute($value)
    {
        $this->attributes['suffix'] = $this->customUcWords($value);
    }

    protected function setHouseNumberAttribute($value)
    {
        $this->attributes['house_number'] = $this->customUcWords($value);
    }
}
