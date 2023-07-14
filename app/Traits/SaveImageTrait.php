<?php

namespace App\Traits;

use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;

trait SaveImageTrait
{
    public function saveImage($file, $path)
    {
        // Generate a unique filename   
        $originalName = $file->getClientOriginalName();
        
        $path = "/public/images";
        $filename = $file->storeAs($path , $originalName);
        // Return the path to the saved image

        return $filename;
    }
}

?>