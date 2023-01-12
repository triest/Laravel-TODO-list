<?php

namespace App\Http\Requests\TODOList;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentDocumentPRRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return Auth::user()->hasPermissionTo('inventory.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:102400',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя обязательно',
            'name.string' => 'Имя должно быть строкой',
            'name.max' => 'Длина имени не более 255 символов',
            'file.file' => 'Должен быть файлом',
            'file.mimes' => 'Неверный формат. Разрешенные форматы: tiff,jpg,png,pdf,docx,xlsx,pptx,rar,zip,7z,tar,tar.bz,tar.gz,txt',
        ];
    }
}
