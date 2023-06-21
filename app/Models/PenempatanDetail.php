<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenempatanDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_penempatan' ,
        'id_company' ,
        'departmenCompany' ,
        'posisi' ,
    ];
    public function getCompany(){
        return $this->belongsTo(Company::class, 'id_company', 'id');
    }
}
