<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNoteModel extends Model
{
    use HasFactory;

    public $table = "debit_note";

    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(DivisionModel::class, 'id_division');
    }
}
