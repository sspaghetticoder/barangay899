<?php

namespace App\Models;

use Carbon\Carbon;

class Resident extends BaseModel
{
    protected $table = 'resident_tbl';
    protected $primaryKey = 'resident_id';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'house_number',
        'alias',
        'sex',
        'birth_date',
        'place_of_birth',
        'civil_status',
        'blood_type',
        'pwd',
        'years_of_residence',
        'citizenship',
        'religion',
        'member_4ps',
        'voter_status',
        'identified_as',
        'email_add',
        'contact_no',
        'emp_stat',
        'occupation',
        'emp_name',
        'monthly_income',
        'floor_no',
        'block_no',
        'street_name',
        'family_relation',
        'sss_no',
        'tin_no',
        'gsis_no',
        'pagibig_no',
        'philhealth_no',
    ];

    public function scopeFindRecord($query, string $lastName = '', string $firstName = '', string $middleName = '', ?string $suffix = null, string $houseNumber = '')
    {
        return $query->where('last_name', $this->customUcWords($lastName))
            ->where('first_name', $this->customUcWords($firstName))
            ->where('middle_name', $this->customUcWords($middleName))
            ->where('suffix', $this->customUcWords($suffix))
            ->where('house_number', $this->customUcWords($houseNumber));
    }

    public function getMonthlyIncomeFormattedAttribute()
    {
        return 'P'.number_format($this->attributes['monthly_income']);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

    public function getBirthDateAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->format('m/d/Y');
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::parse($value);
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'resident_id');
    }
}
