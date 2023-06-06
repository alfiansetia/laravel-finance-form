<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionModel extends Model
{
    use HasFactory;

    public $table = "description";

    protected $guarded = ['id'];
}
