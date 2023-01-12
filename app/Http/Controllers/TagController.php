<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\IndexTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagCollection;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\ToDoList\TodoListCollection;
use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{

    public TagService $tagService;

    /**
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return TagCollection
     */
    public function index(IndexTagRequest $request): TagCollection
    {
        $collection = $this->tagService->index($request);

        return TagCollection::make($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return TagResource
     */
    public function store(CreateTagRequest $request): TagResource
    {
        $tag = $this->tagService->create($request->validated());

        return TagResource::make($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TagResource
     */
    public function show(Tag $tag): TagResource
    {
        $tag = $this->tagService->show($tag);

        return TagResource::make($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return TagResource
     */
    public function update(UpdateTagRequest $request, Tag $tag): TagResource
    {

        $tag = $this->tagService->update($tag, $request->validated());

        return TagResource::make($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag): \Illuminate\Http\Response
    {
        $this->tagService->destroy($tag);
    }
}
