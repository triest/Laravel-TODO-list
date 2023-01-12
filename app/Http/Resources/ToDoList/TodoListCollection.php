<?php

namespace App\Http\Resources\ToDoList;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoListCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(
                function ($item) {
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }),
        ];
    }

}
