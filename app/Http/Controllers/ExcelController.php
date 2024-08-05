<?php

namespace App\Http\Controllers;

use App\Http\Requests\Excel\UploadRequest;
use App\Services\ExcelService;
use Inertia\Response;
use Inertia\ResponseFactory;

class ExcelController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Excel');
    }

    public function upload(UploadRequest $uploadRequest, ExcelService $excelService): void
    {
        $excelService->upload($uploadRequest);
    }
}
