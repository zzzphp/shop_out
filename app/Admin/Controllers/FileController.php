<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Traits\HasUploadedFile;
use Illuminate\Support\Facades\Storage;
class FileController
{
    use HasUploadedFile;

    public function handle()
    {
        $disk = $this->disk('admin');

        // 判断是否是删除文件请求
        if ($this->isDeleteRequest()) {
            // 删除文件并响应
            return $this->deleteFileAndResponse($disk);
        }

        // 获取上传的文件
        $file = $this->file();

        // 获取上传的字段名称
        $column = $this->uploader()->upload_column;

        $dir = 'images';
        $newName = $column.md5(time().mt_rand(10000,999999)).'.'.$file->getClientOriginalExtension();

        $result = $disk->putFileAs($dir, $file, $newName);

        $path = "{$dir}/$newName";
        $path = $disk->url($path);
        return $result
            ? $this->responseUploaded($path, $path)
            : $this->responseErrorMessage('文件上传失败');
    }
}