<?php

namespace App\Http\Controllers;

use cloudinary;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImageToCloudinary($file)
    {
        $resizedImage = cloudinary()->upload(request()->file($file)->getRealPath(), [
            'folder' => 'uploads',
            'transformation' => [
                      'width' => 800,
                      'height' => 800
             ]
        ])->getSecurePath();

        return $resizedImage;
    }
}
