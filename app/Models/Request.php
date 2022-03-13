<?php

namespace App\Models;

class Request extends BaseModel
{
    protected $table = 'request_tbl';
    protected $primaryKey = 'request_id';
    protected $fillable = [
        'resident_id',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'house_number',
        'street',
        'email_add',
        'contact_number',
        'purpose',
        'name_of_witness',
        'request_status',
        'resident_status',
        'confirmed_at',
    ];

    public array $resident_statuses = [
        'current_resident' => 'c',
        'new_resident' => 'n'
    ];

    protected function getContactNumberFormattedAttribute()
    {
        return substr($this->contact_number, 0, 4).'-'.substr($this->contact_number, 4, 3).'-'.substr($this->contact_number, -4, 4);
    }

    protected function getPurposesAttribute()
    {
        return explode(',', $this->purpose);
    }

    protected function getFullNameAttribute() : string
    {
        $suffix = trim($this->suffix) ? '('.$this->suffix.')': '';
    
        return "{$this->last_name}, {$this->first_name} {$this->middle_name} {$suffix}";
    }    

    protected function getAddressAttribute() : string
    {
        return "{$this->house_number}, {$this->street}";
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'request_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }
}
