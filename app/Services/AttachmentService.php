<?php

namespace App\Services;


use App\Models\Attachment;
use App\Models\File;
use App\Traits\UploadFileTrait;

class AttachmentService
{
    use UploadFileTrait;

    public function index($model)
    {
        return $model->attachments;
    }

    public function indexByType(object $model, string $type)
    {
        return $model->attachments()->where('type', $type)->get();
    }

    /**
     * @param array $data
     * @param string $type
     * @return Attachment
     */
    public function create(array $data, string $type = Attachment::TYPE_PHOTO): Attachment
    {
        $file = new File();
        $file->path = 'attachments/'. $this->uploadFile($data['file'], 'attachments');
        $file->save();
        $data['fileId'] = $file->id;
        $data['type'] = $type;

        return Attachment::create($data)->fresh();
    }

    /**
     * @param Attachment $attachment
     */
    public function delete(Attachment $attachment): void
    {
        $attachment->delete();
    }

}
