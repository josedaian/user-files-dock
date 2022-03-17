<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService {
    protected $file;
    
    private function __construct($file)
    {
        $this->file = $file;
    }

    static function upload($file){
        return (new FileUploadService($file))->_uploadFile();
    }

    private function _uploadFile(): array{
        $fileName = $this->file->getClientOriginalName();
        $this->file->storeAs('.', $fileName, 'public');
        return [
            'name' => $fileName,
            'url' => Storage::disk('public')->url($fileName)
        ];
    }
}