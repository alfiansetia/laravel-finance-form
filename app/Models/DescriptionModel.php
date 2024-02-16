<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionModel extends Model
{
    use HasFactory;

    public $table = "description";

    protected $guarded = ['id'];

    public function payment()
    {
        return $this->belongsTo(PaymentRequestModel::class, 'id_payment_request');
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
