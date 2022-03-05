<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'resident_tbl';
    protected $primaryKey = 'resident_id';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
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
        'resident_status',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::parse($value);
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'request_id');
    }
}
