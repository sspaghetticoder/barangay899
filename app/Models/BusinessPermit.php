<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPermit extends Model
{
    use HasFactory;

    protected $table = 'business_permit_tbl';
    protected $primaryKey = 'business_permit_id';
    protected $fillable = [
        'business_name',
        'business_nature',
        'business_owner',
        'owners_add',
        'business_add',
        'business_phone',
        'date_applied',
        'date_expiration',
        'permit_status',
        'remarks'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }
}
