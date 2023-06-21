<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_penempatan',
        'tgl_penempatan',
        'id_hrd'
    ];

    public function detail()
    {
        return $this->hasMany(PenempatanDetail::class, 'no_penempatan', 'no_penempatan');
    }

    public function getManager()
    {
        return $this->belongsTo(User::class, 'id_hrd', 'id');
    }
}
