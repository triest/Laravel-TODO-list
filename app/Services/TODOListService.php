<?php

namespace App\Services;

use App\Filters\ToDoListFilter;
use App\Http\Requests\TODOList\IndexTodoListRequest;
use App\Models\Tag;
use App\Models\TodoList;
use App\Sorters\ToDoListSorter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
        $user = Auth::user();
        dump($user); die();
        if($user){
            $todoList->user()->save($user);
        }
        $todoList->save();
        return $todoList;
    }

    public function update(TodoList $todoList, array $array)
    {
        $todoList->update($array);

        $todoList->save();

        return $todoList->refresh();
    }

    public function show(TodoList $todoList)
    {
        return $todoList;
    }

    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
    }


    public function addTag(TodoList $todoList, array $tagsIdArray)
    {
        $tagsIdArray = $tagsIdArray['tags'];

        DB::beginTransaction();
        $tagsArray = [];

        $todoList->tags()->detach();

        if (empty($tagsIdArray)) {
            DB::commit();
            return;
        }

        foreach ($tagsIdArray as $item) {
            $temp = Tag::where('id', $item)->first();
            if (!$temp) {
                DB::rollBack();
                throw new NotFoundResourceException();
            }
            $tagsArray[] = $temp;
        }

        $todoList->tags()->saveMany($tagsArray);

        DB::commit();
    }
}
