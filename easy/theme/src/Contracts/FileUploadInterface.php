<?php

namespace Easy\Theme\Contracts;

interface FileUploadInterface
{
    /**
     * media root directory
     */
    const MEDIA_ROOT_DIRECTORY = 'media';
    /**
     * image root directory
     */
    const IMAGE_ROOT_DIRECTORY = 'image';
    /**
     * Fallback placeholder
     */
    const NO_FILE_PLACEHOLDER_PATH = 'media/image/noImage.png';
    /**
     * getTree
     *
     * @param array $arrayList
     * @param bool $isSortRequired
     * @return array
     */
    public function storeResizedImage(mixed $file, string $directory, int $height ) : string;
}
