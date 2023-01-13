<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\TODOList\AddTagToToDoListRequest;
use App\Http\Requests\TODOList\CreateTodoListRequest;
use App\Http\Requests\TODOList\IndexTodoListRequest;
use App\Http\Requests\TODOList\UpdateTodoListRequest;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\ToDoList\TodoListCollection;
use App\Http\Resources\ToDoList\TodoListResource;
use App\Models\TodoList;
use App\Services\TODOListService;

class TodoListController extends Controller
{

    public TODOListService $TODOListService;

    /**
     * @param TODOListService $TODOListService
     */
    public function __construct(TODOListService $TODOListService)
    {
        $this->TODOListService = $TODOListService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return TodoListCollection
     */
    public function index(IndexTodoListRequest $request)
    {
        $collection = $this->TODOListService->index($request);

        return TodoListCollection::make($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return TodoListResource
     */
    public function store(CreateTodoListRequest $request)
    {
        $todolist = $this->TODOListService->create($request->validated());

        return TodoListResource::make($todolist);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TodoListResource
     */
    public function show(TodoList $todo_list)
    {
        $todolist = $this->TODOListService->show($todo_list);

        return TodoListResource::make($todolist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return TodoListResource
     */
    public function update(UpdateTodoListRequest $request, TodoList $todo_list)
    {
        $todolist = $this->TODOListService->update($todo_list, $request->validated());

        return TodoListResource::make($todolist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todo_list)
    {
        $this->TODOListService->destroy($todo_list);
    }


    public function addTag(TodoList $todoList,AddTagToToDoListRequest $request){
        $this->TODOListService->addTag($todoList,$request->validated());
    }

    public function getTags(TodoList $todoList){

        return TagResource::collection($todoList->tags);
    }

}
