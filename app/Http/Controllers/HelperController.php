<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class HelperController extends Controller
{
    //
    public function twillioMsg($ph, $message)
    {
        try {
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_AUTH_TOKEN");
            $twilio_number = env("TWILIO_NUMBER");
        } catch (\Exception $e) {
        }
    }
    public function uploadfile($file, $path)
    {
        $name = uniqid() . '.' . $file->getClientOriginalExtension();
        if (env("FILE_SYSTEM") == "s3") {
            Storage::disk('s3')->putFileAs($path, $file, $name, 'public');
        } elseif (env("FILE_SYSTEM") == "wasabi") {
            Storage::disk('wasabi')->putFileAs($path, $file, $name, 'public');
        } else {
            $destinationPath = public_path('/' . $path);
            $file->move($destinationPath, $name);
        }
        return $path . '/' . $name;
    }
    public function deleteImage($fileName)
    {
        try {
            if ($fileName == "default.svg") {
                return false;
            }
            if (env("FILE_SYSTEM") == "s3") {
                Storage::disk('s3')->delete($fileName);
            } elseif (env("FILE_SYSTEM") == "wasabi") {
                Storage::disk('wasabi')->delete($fileName);
            } else {
                $filePath = public_path() . '/' . $fileName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
