<?php
namespace App\Services;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;

class UserService
{
    public function handlerFileUpload($fileData, $name, $folder, $oldFile=null)
    {
        if($oldFile) {
            if(FacadesFile::exists(public_path($oldFile))){
                FacadesFile::delete(public_path($oldFile));
            }
        }
        $extension = $fileData->getClientOriginalExtension();
        $filePath = $fileData->storeAs($folder, Str::slug("$name-".Str::uuid()).".$extension", 'public');
        return "/storage/$filePath";
    }
}
