<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class FileUploader{

    public static function image($file=null, $path=''){
        $result = new \stdClass();
        $result->isUploaded = false;
        $result->filename   = null;

        if($file){
            $uploadedImgPath = $file->storePublicly($path, 'uploads');
            $result->isUploaded   = true;
            $result->filename     = $uploadedImgPath;
        }
        return $result;
    }

    public static function delete($file=null){
        if($file){
            $path = public_path('uploads/'.$file);
//            dd($path);
            if(file_exists($path)){
                File::delete($path);
            }
        }
    } // delete

}
