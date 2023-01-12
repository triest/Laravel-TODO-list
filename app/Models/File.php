<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends BaseModel
{
    use HasFactory,  SoftDeletes;

    public $fillable = [
        'path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function relativeUrl(): string
    {
        return Storage::url($this->path);
    }

    public function mime(): string
    {
        if(Storage::disk('public')->exists($this->path)) {
            return Storage::disk('public')->mimeType($this->path);
        }else{
            return "";
        }
    }
}
