<?php

namespace App\Services;

use App\Filters\ToDoListFilter;
use App\Http\Requests\TODOList\IndexTodoListRequest;
use App\Models\TodoList;
use App\Sorters\ToDoListSorter;

class TODOListService
{

    public function index(IndexTodoListRequest $request)
    {
        $filters = new ToDoListFilter($request);
        $sorters = new ToDoListSorter($request);

        $perPage = (int)$request->perPage;

        return TodoList::filter($filters)->sort($sorters)->paginate($perPage);
    }

    public function create(array $array): TodoList
    {
        $todoList = new TodoList();
        $todoList->fill($array);
        $todoList->save();
        return $todoList;
    }

    public function update(TodoList $todoList, array $array)
    {
        $todoList->update($array);

        $todoList->save();

        return $todoList;
    }

    public function show(TodoList $todoList)
    {
        return $todoList;
    }

    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
    }
}
