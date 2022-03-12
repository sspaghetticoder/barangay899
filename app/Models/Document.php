<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'document_tbl';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'amount',
        'or_no',
        'document_type'
    ];

    public $barangayDocuments = [
        'r' => 'Certificate of Residency',
        'i' => 'Certificate of Indigency', 
        'c' => 'Barangay Clearance',
        'b' => 'Business Permit'
    ];

    protected function getNameAttribute() : string
    {
        return $this->barangayDocuments[$this->document_type];
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'request_id');
    }

    public function business_permit()
    {
        return $this->hasOne(BusinessPermit::class, 'document_id');
    }
}
