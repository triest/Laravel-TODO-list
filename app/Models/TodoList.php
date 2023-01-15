<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TodoList extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'entity');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
