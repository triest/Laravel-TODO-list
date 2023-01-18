<?php

namespace App\Services;


use App\Models\Attachment;
use App\Models\File;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
        $patch = $data['entity_id'];
        $file = new File();
        $file->path = 'attachments/' . $this->uploadFile($data['file'], $patch);

        $file->save();
        $data['fileId'] = $file->id;
        $data['type'] = $type;

        $input['imagename'] = time() . '.' . $data['file']->extension();

        $destinationPath = public_path('\temp');
        $img = Image::make($data['file']->path());
        $temp = $img->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '\\' . $input['imagename']);


        $fileName = md5($temp->basename). Str::uuid().'.'.$temp->extension;

        $patch = Storage::disk('public')->put('/' . $data['entity_id'] . '/' . $fileName, $temp);

        $file = new File();
        $file->path = 'attachments/'.$data['entity_id']. '/' . $fileName;
        $file->save();

        $data['previewId'] = $file->id;


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
