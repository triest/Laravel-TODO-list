<?php

namespace App\Http\Resources\ToDoList;

use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'attachment' => $this->attachments ? AttachmentResource::collection($this->attachments) : null,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
        ];
    }
}
