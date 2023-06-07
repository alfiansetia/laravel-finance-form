<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionModel extends Model
{
    use HasFactory;

    public $table = "division";

    protected $guarded = ['id'];

    public function payment()
    {
        return $this->belongsTo(PaymentRequestModel::class, 'id');
    }

    public function debit()
    {
        return $this->belongsTo(DebitNoteModel::class, 'id');
    }

}
