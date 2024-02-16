<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionDebitModel extends Model
{
    use HasFactory;

    public $table = "decription_debit";

    protected $guarded = ['id'];

    public function debit()
    {
        return $this->belongsTo(DebitNoteModel::class);
    }

    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }

    public function wht()
    {
        return $this->belongsTo(Wht::class);
    }
}
