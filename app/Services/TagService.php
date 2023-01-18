<?php

namespace App\Services;

use App\Filters\ToDoListFilter;
use App\Http\Requests\Tag\IndexTagRequest;
use App\Http\Requests\TODOList\IndexTodoListRequest;
use App\Models\Tag;
use App\Models\TodoList;
use App\Sorters\ToDoListSorter;

class TagService
{
    public function index(IndexTagRequest $request)
    {
        $filters = new ToDoListFilter($request);
        $sorters = new ToDoListSorter($request);

        $perPage = (int)$request->perPage;

        return Tag::filter($filters)->sort($sorters)->paginate($perPage);
    }

    public function create(array $array): Tag
    {
        $tag = new Tag();
        $tag->fill($array);
        $tag->save();
        return $tag;
    }

    public function update(Tag $tag, array $array): Tag
    {
        $tag->update($array);

        $tag->save();

        return $tag->refresh();
    }

    public function show(Tag $tag): Tag
    {
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
    }
}
