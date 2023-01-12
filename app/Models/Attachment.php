<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends BaseModel
{


    public const TYPE_PHOTO = 'PHOTO';
    public const TYPE_DOCUMENT = 'DOCUMENT';

    public const TYPES = [
        self::TYPE_PHOTO,
        self::TYPE_DOCUMENT,
    ];

    public $fillable = [
        'entityType',
        'entityId',
        'fileId',
        'name',
        'type',
    ];

    /**
     * @return JsonResource
     */
    public function toResource(): JsonResource
    {
        return AttachmentResource::make($this);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

