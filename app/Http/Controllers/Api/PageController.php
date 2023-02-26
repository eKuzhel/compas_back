<?php

namespace App\Http\Controllers\Api;

use App\Models\File;
use App\Models\PageFile;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function one(int $id): array
    {
        $model = PageFile::query()->where(['id' => $id])->first();
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return [
            'id' => $model->id,
            'name' => $model->name,
            'content' => $model->content,
            'files' => array_map(function (File $file) {
                return [
                    'id' => $file->id,
                    'name' => $file->name,
                    'url' => Storage::url($file->path),
                ];
            }, (array)$model->files()->get()->all())
        ];
    }

}
