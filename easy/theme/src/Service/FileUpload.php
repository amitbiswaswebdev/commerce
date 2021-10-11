<?php

namespace Easy\Theme\Service;

use Easy\Theme\Contracts\FileUploadInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;
/**
 * Tree
 */
class FileUpload implements FileUploadInterface
{
    /**
     * @inheritDoc
     */
    public function storeResizedImage(mixed $file, string $directory, int $height ) : string
    {
        $imageName = time() .'.'. $file->getClientOriginalExtension();
        $img = Image::make($file->getRealPath());
        $img->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $directoryPath = self::MEDIA_ROOT_DIRECTORY .'/'. self::IMAGE_ROOT_DIRECTORY .'/'. $directory;
        $storePath = storage_path($directoryPath);
        (new Filesystem)->ensureDirectoryExists($storePath);
        $img->save($storePath .'/'. $imageName , 75);
        return $directoryPath .'/'. $imageName;
    }

    public function storeFile(mixed $file, string $storePath, string $retrievePath) : string
    {
        if ($file) {
            $fileNameWithExt = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt , PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $newFileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $storePath = $file->storeAs('media' .'/'. $storePath, $newFileNameToStore);
            return $retrievePath . $newFileNameToStore;
        }
    }

}
