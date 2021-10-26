<?php

namespace Easy\Theme\Service;

use Easy\Theme\Contracts\FileUploadInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use SplFileInfo;
/**
 * Tree
 */
class FileUpload implements FileUploadInterface
{
    /**
     * storeFile
     *
     * @param mixed $file
     * @param string $storePath
     * @param string $retrievePath
     * @return string
     */
    public function storeFile(mixed $file, string $storePath, string $retrievePath) : string
    {
        $fileNameWithExt = $file->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt , PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $newFileNameToStore = $fileName . '_' . time() . '.' . $extension;
//        $storePath = $file->storeAs('media' .'/'. $storePath, $newFileNameToStore);
        return $retrievePath . $newFileNameToStore;
    }

    /**
     * getResizedImagePath
     *
     * @param array $files
     * @param string $retrievePath
     * @param int $height
     * @return array
     */
    public function createResizedImagePath(array $files, string $retrievePath, int $height) : array
    {
        $storedImagePath = [];
        if (sizeof($files)) {
            foreach ($files as $key => $fileObject) {
                $uploadFile = $fileObject['file'];
                if ($uploadFile instanceof SplFileInfo && $uploadFile->getPath() !== '') {
                    $storedImagePath[$key] = $this->store($uploadFile, $retrievePath, $height);
                } elseif (!$uploadFile && $fileObject['id'] && is_string($fileObject['url'])) {
                    $storedImagePath[$key] = $fileObject['url'];
                }else{
                    $storedImagePath[$key] = self::NO_FILE_PLACEHOLDER_PATH;
                }
            }
        }
        return $storedImagePath;
    }

    /**
     * @param mixed $file
     * @param string $directory
     * @param int $height
     * @return string
     */
    private function store(mixed $file, string $directory, int $height): string
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
        return '/storage' .'/'. self::IMAGE_ROOT_DIRECTORY .'/'. $directory .'/'. $imageName;
    }

    /**
     * resizedImagePath
     *
     * @param array $files
     * @param string $path
     * @param int $height
     * @return array
     */
    public function updateResizedImagePath(array $files, string $path, int $height) : array
    {
        if (sizeof($files)) {
            foreach ($files as $key => $value) {
                if ( $value['id'] && $value['url'] !== '' && (int) $value['show'] === 0) {
                    $this->deleteFileFromDirectory($value['url']);
                    array_splice($files,$key,1);
                }
            }
        }
        $files = (sizeof($files)) ? $files : [];
        return $this->createResizedImagePath($files, $path, $height);
    }

    /**
     * deleteFileFromDirectory
     *
     * @param string $path
     * @return bool
     */
    public function deleteFileFromDirectory(string $path) : bool
    {
        $filePath = str_replace("storage/", "", $path);
        if (Storage::exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return true;
        }
        return false;
    }
}
