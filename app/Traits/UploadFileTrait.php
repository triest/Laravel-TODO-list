<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFileTrait
{
    private function uploadFile($file, string $path): string
    {
        $fileName = md5_file($file->path()) . '.' . $file->extension();;

        return Storage::disk('public')->put($path, $file);;
    }

}
