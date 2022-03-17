<?php

namespace App\Http\Requests;

class FileUploadRequest  extends BaseFormRequest
{
    public function rules()
    {
        return [
            'file' => 'required|file',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => __('El campo file es requerido'),
            'file.file' => __('El valor del campo file debe ser un archivo'),
        ];
    }
}