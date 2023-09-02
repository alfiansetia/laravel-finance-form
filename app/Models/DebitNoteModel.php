<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNoteModel extends Model
{
    use HasFactory;

    public $table = "debit_note";

    protected $guarded = ['id'];

    function getNoDebitNoteAttribute($value)
    {
        $no = str_pad($value, 4, '0', STR_PAD_LEFT);
        return $no . '/' . $this->division->slug . '-DN' . date('/m/y', strtotime($this->debit_note_date));
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->desc as $item) {
            $total = $total + $item->price;
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
        return $this->hasMany(DescriptionDebitModel::class, 'id_debit_note');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function filedn()
    {
        return $this->hasMany(Filedn::class, 'debit_id');
    }
}
