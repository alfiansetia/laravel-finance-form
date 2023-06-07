<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequestModel extends Model
{
    use HasFactory;

    public $table = "payment_request";

    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(DivisionModel::class, 'id_division');
    }

    public function wht()
    {
        return $this->belongsTo(Wht::class);
    }
}
