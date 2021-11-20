<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakHoursSetting extends Model
{
    use HasFactory;

    protected $fillable = ['hours', 'break'];
}
