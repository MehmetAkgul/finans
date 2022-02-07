<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileUpload
{

    public static function newUpload($name, $file, $type = 0): string
    {
        $dir = 'images/' . $name;

        if (!empty($file)) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }


            $filename = time() . '.' . $file->getClientOriginalExtension();

            if ($type == 0) {
                $path = public_path($dir . '/' . $filename);
                Image::make($file->getRealPath())->save($path);
            } else {
                $path = public_path($dir . '/');
                Image::move($path, $filename);
            }
            return $dir . '/' . $filename;
        } else {
            return "";
        }
    }

    public static function changeUpload($name, $file, $type = 0, $data, $field): string
    {
        $dir = 'images/' . $name;


        if (!empty($file)) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $filename = time() . '.' . $file->getClientOriginalExtension();

            if ($type == 0) {
                $path = public_path($dir . '/' . $filename);
                Image::make($file->getRealPath())->save($path);
            } else {
                $path = public_path($dir . '/');
                Image::move($path, $filename);
            }

            if ($data->$field != "") {
                File::delete(public_path() . '/' . $data->$field);
            }

            return $dir . '/' . $filename;

        } else {
            return $data->$field;
        }
    }


}