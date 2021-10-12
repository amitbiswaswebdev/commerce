<?php

namespace Easy\Theme\Service;

use Easy\Theme\Contracts\FileUploadInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
/**
 * Tree
 */
class FileUpload implements FileUploadInterface
{
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

    public function getResizedImagePath(array $files, string $path, int $height) : array
    {
        $storedImagePath = [];
        if (sizeof($files)) {
            foreach ($files as $key => $fileObject) {
                $uploadFile = $fileObject['file'];
                if ($uploadFile !== null && $uploadFile instanceof SplFileInfo && $uploadFile->getPath() !== '') {
                    $storedImagePath[$key] = $this->store($uploadFile, $path, $height);
                } elseif (!$uploadFile && $fileObject['id'] && is_string($fileObject['url'])) {
                    $storedImagePath[$key] = $fileObject['url'];
                }else{
                    $storedImagePath[$key] = self::NO_FILE_PLACEHOLDER_PATH;
                }
            }
        }
        return $storedImagePath;
    }

    private function store(mixed $file, string $directory, int $height)
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
}
