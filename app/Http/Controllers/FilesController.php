<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function download($filename)
    {
        //
    }

    /**
     * 响应对 GET /file/{filename} 的请求
     * 用于显示某个文件（通常是媒体类型文件，如：图片、视屏等）
     *
     * @param $filename file on local storage
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        $file = Storage::disk('local')->get($filename);
        $mime = Storage::disk('local')->mimeType($filename);

        return (new Response($file, 200))->header('Content-type', $mime);
    }
}
