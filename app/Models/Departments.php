<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'location', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(Positions::class, 'manager_id');
    }
}
