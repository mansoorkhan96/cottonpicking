<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickingnumber extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
