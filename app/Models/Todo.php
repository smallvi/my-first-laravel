<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'is_active',
        'todo',
    ];

    public function getUpdatedAtAttribute($value)
    {

        // return date('Y-m-d H:i', strtotime($value));

        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
}
