<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function settlement_type()
    {
        return $this->belongsTo(Settlement_type::class);
    }

}
