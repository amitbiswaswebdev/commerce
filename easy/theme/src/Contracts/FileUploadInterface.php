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
     * getResizedImagePath
     *
     * @param array $files
     * @param string $retrievePath
     * @param int $height
     * @param bool $multiple
     * @return string
     */
    public function getResizedImagePath(array $files, string $retrievePath, int $height) : array;
}
