<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PaymentRequestModel extends Model
{
    use HasFactory;

    public $table = "payment_request";

    protected $guarded = ['id'];

    function getNoPrAttribute($value)
    {
        $no = str_pad($value, 4, '0', STR_PAD_LEFT);
        return $no . '/' . $this->division->slug . '-PR' . date('/m/y', strtotime($this->date_pr));
    }

    public function getDeadlineAttribute()
    {
        if ($this->due_date > 0) {
            $received_date = Carbon::parse($this->received_date);
            return $received_date->addDays($this->due_date)->format('d-M-y');
        } else {
            return 'ASAP';
        }
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->desc as $item) {
            $total = $total + $item->price;
        }
        return $total;
    }

    public function getTotalregAttribute()
    {
        $total = 0;
        foreach ($this->desc as $item) {
            if ($item->type == 'reg') {
                $total = $total + $item->price;
            }
        }
        return $total;
    }

    public function division()
    {
        return $this->belongsTo(DivisionModel::class, 'id_division');
    }

    public function wht()
    {
        return $this->belongsTo(Wht::class);
    }

    public function desc()
    {
        return $this->hasMany(DescriptionModel::class, 'id_payment_request');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function filepr()
    {
        return $this->hasMany(Filepr::class, 'payment_id');
    }
}
