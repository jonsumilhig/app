<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
    public function formatImage (UploadedFile $file)
    {
        $image = Image::make($file->getRealPath())->fit(750,750)->stream();
        return 'data:image/'.strtolower($file->getClientOriginalExtension()).';base64,'.base64_encode($image);
    }

    public function storeProfilePhoto (UploadedFile $file)
    {
        Storage::disk('public')->put($filename = $this->filename('profile', 'jpg'), $this->imageStatic($file->getRealPath(), 'jpg'));
        return $filename;
    }

    private function imageStatic ($path, $format)
    {
        return ImageManagerStatic::make($path)->encode($format);
    }

    private function filename ($folder, $format) {
        return "$folder/".Str::random(). ".$format";
    }
}
