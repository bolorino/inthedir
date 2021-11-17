<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('itdStateColor')) {
    function itdStateColor()
    {

    }
}

if (!function_exists('saveImage')) {
    /**
     * @param UploadedFile $file
     * @param string $path
     * @param string $fileName
     * @return string
     */
    function saveImage(UploadedFile $file, string $path, string $fileName): string
    {
        Storage::disk('public')->putFileAs($path, $file, $fileName);

        return $fileName;
    }
}

if (!function_exists('createThumbnail')) {
    /**
    * Create a thumbnail of specified size
    *
    * @param string $path path of thumbnail
    * @param int $width
    * @param int $height
    */
    function createThumbnail(string $path, int $width, int $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}