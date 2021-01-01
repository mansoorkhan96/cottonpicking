<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
    use HasFactory;

    public function labour()
    {
        return $this->belongsTo(User::class, 'labour_id');
    }
}
