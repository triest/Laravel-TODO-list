<?php

namespace App\Http\Requests;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->file->relativeUrl(),
            'mime' => $this->file->mime(),
        ];
    }

}
