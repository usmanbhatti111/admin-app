<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait {

    public function fileUpload($photo,$path=null){
        $imagename = uniqid().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('site_images/'.$path);
        
        $photo->move($destinationPath, $imagename);
        return $imagename;
    }
    public function fileDeleted($photo,$path=null){
        $image_path = public_path('site_images/'.$path.'/'.$photo);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }    
    }
}
