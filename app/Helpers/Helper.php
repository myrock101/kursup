<?php

use Illuminate\Support\Facades\Storage;


if (!function_exists('file_asset')) {

    function file_asset($file)
    {
        if ($file == 'default.svg')
            return asset($file);

        if (env("FILE_SYSTEM") == "s3") {
            return Storage::disk('s3')->url($file);
        } elseif (env("FILE_SYSTEM") == "wasabi") {
            return Storage::disk('wasabi')->url($file);
        } else {
            return asset($file);
        }
    }
}
if (!function_exists('static_asset')) {

    function static_asset($file)
    {

        if (env("CONTENT_PROVIDER") == "bunny") {
            return env("BUNNY_URL") . $file;
        } else {
            return asset($file);
        }
    }
}
