<?php

namespace App\Services;

use App\Http\Requests\Excel\UploadRequest;

class ExcelService
{
    public function upload(UploadRequest $uploadRequest)
    {
        $data = $uploadRequest->validated();
        $file = $data['file'];
        $originalName = $file->getClientOriginalName();
        return $file->storeAs('public', $originalName);
    }
}
