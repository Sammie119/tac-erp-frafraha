<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

abstract class Controller
{
    protected function imageUpload($image, $folder = 'products', $file_url = null)
    {
        if($file_url !== null){
            $file = 'storage/'.$file_url;
            if (File::exists(public_path($file))) {
                File::delete($file);
            }
        }
//        dd('controller', $file);
        $destinationPath = 'storage/uploads/'.$folder;
        $file = 'tac'.date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $file);

        $filename = 'uploads/'.$folder.'/'.$file;
        return $filename;
    }
}
