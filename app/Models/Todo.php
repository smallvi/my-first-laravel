<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    public $timestamp = true;

    protected $fillable = [
        'is_active',
        'todo',
    ];


}
