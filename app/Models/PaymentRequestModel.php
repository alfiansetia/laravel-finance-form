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
        foreach ($this->desc ?? [] as $item) {
            if ($item->type == 'reg') {
                $total = $total + $item->price;
            }
        }
        return $total;
    }

    public function getTotalvataddAttribute()
    {
        $grand_total = 0;
        foreach ($this->desc ?? [] as $item) {
            if ($item->type == 'add') {
                $vat_value = 0;
                $total = $item->price ?? 0;
                $vat = $item->vat->value ?? 0;
                if ($vat > 0) {
                    $vat_value = round(($total * $vat) / 100, 2);
                }
                $grand_total += $vat_value;
            }
        }
        return $grand_total;
    }

    public function getTotalwhtaddAttribute()
    {
        $grand_total = 0;
        foreach ($this->desc ?? [] as $item) {
            if ($item->type == 'add') {
                $wht_value = 0;
                $total = $item->price ?? 0;
                $wht = $item->wht->value ?? 0;
                if ($wht > 0) {
                    $wht_value = round(($total * $wht) / 100, 2);
                }
                $grand_total += $wht_value;
            }
        }
        return $grand_total;
    }

    public function getTotaladdAttribute()
    {
        $grand_total = 0;
        foreach ($this->desc ?? [] as $item) {
            if ($item->type == 'add') {
                $vat_value = 0;
                $wht_value = 0;
                $total = $item->price ?? 0;
                $vat = $item->vat->value ?? 0;
                $wht = $item->wht->value ?? 0;
                if ($vat > 0) {
                    $vat_value = round(($total * $vat) / 100, 2);
                }
                if ($wht > 0) {
                    $wht_value = round(($total * $wht) / 100, 2);
                }
                $grand_total += ($total + $vat_value - $wht_value);
            }
        }
        return $grand_total;
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

    public function validator()
    {
        return $this->belongsTo(Validator::class, 'validator_id');
    }

    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }
}
