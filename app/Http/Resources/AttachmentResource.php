<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->file->relativeUrl(),
            'preview_path' => $this->preview ? $this->preview->relativeUrl() : null,
            'mime' => $this->file->mime(),
        ];
    }

}
