<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function division()
    {
        return $this->belongsTo(DivisionModel::class);
    }
}
