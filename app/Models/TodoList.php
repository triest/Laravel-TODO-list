<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TodoList extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
}
