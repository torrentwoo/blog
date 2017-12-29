<?php

namespace App\Http\Controllers;

use Image;
use Storage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only'  =>  ['upload'],
        ]);
    }

    /**
     * 响应对 GET /file/{filename} 的请求
     * 用于显示某个文件（通常是多媒体类型文件，如：图像、音频、视频等）
     *
     * @param string $filename the file on local storage
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        $file = Storage::disk('local')->get($filename);
        $mime = Storage::disk('local')->mimeType($filename);

        return (new Response($file, 200))->header('Content-type', $mime);
    }

    public function upload(Request $request, $type)
    {
        switch (true) {
            case ($type === 'image') :
                return $this->uploadImage($request);
                break;
            default :
                // do nothing yet
        }
    }

    protected function uploadImage(Request $request)
    {
        $response = [
            'error' =>  true,
            'message'   =>  'Wait for image upload',
        ];
        $this->validate($request, [
            'image' =>  'image|max:1024', // unit: kb
        ], [
            'image.image'   =>  '本地图片 必须是有效的图片1',
            'image.max'     =>  '本地图片 不能大于 1M',
        ]);
        if ($request->hasFile('image') && config('filesystems.default') === 'local') {
            $root = config('filesystems.disks.local.root');
            $pathname = 'attachment/image/' . date('Ym');
            $basename = $_SERVER['REQUEST_TIME'] . '.jpg';
            if (empty($pathname) !== true) {
                Storage::makeDirectory($pathname);
                $filename = "{$pathname}/{$basename}";
            } else {
                $filename = $basename;
            }
            $response = [
                'error' =>  false,
                'file'  =>  'file/' . $filename,
                'message'   =>  'Image upload succeed',
            ];

            $image = Image::make($request->file('image'))->save("{$root}/{$filename}");
        }
        return response()->json($response);
    }

    /**
     * 响应对 GET /file/download/{filename} 的请求
     * 用于下载某个（或一些）文件，并提供额外的操作选项，用于如归档、打包等操作请求
     *
     * @param string $filename the file on local storage
     */
    public function download($filename)
    {
        //
    }
}
