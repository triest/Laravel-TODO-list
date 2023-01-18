<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function todolist()
    {
        return $this->belongsToMany(TodoList::class);
    }
}
