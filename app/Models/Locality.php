<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;
    protected $guarded = [];


    //protected $appends = ['created_at', 'updated_at'];

    public function federal_entity()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class)->with('settlement_type');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }



}
