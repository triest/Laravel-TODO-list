<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentResource;
use App\Http\Requests\TODOList\StoreAttachmentDocumentPRRequest;
use App\Models\Attachment;
use App\Models\TodoList;
use App\Services\AttachmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TodoListAttachController extends Controller
{

    private AttachmentService $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TodoList $todoList): \Illuminate\Http\JsonResponse
    {
        $attachments = $this->attachmentService->indexByType($todoList, Attachment::TYPE_DOCUMENT);
        return AttachmentResource::collection($attachments)->response();
    }


    public function store(TodoList $todoList, StoreAttachmentDocumentPRRequest $request)
    {
        $attributes = $request->validated();
        $attributes['entityType'] = TodoList::class;
        $attributes['entityId'] = $todoList->id;
        $attachment = $this->attachmentService->create($attributes, Attachment::TYPE_DOCUMENT);
        return AttachmentResource::make($attachment)->response()->setStatusCode(201);
    }


    public function destroy(TodoList $todoList, Attachment $attachment): JsonResponse
    {
        $this->attachmentService->delete($attachment);
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

}
