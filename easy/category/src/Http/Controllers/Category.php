<?php

namespace Easy\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Easy\Category\Models\Category as CategoryModel;
use Easy\Theme\Contracts\FileUploadInterface;
use Easy\Theme\Contracts\TreeInterface;
/**
 * Category
 */
class Category extends Controller
{
    /**
     * Banner path
     */
    const BANNER_PATH = 'catalog/category/banner';
    /**
     * Meta Image Path
     */
    const META_IMAGE_PATH = 'catalog/category/meta_image';

    /**
     * tree service interface
     */
    protected TreeInterface $tree;

    /**
     * image service interface
     */
    protected FileUploadInterface $fileUpload;

    /**
     * image service interface
     */
    protected CategoryModel $categoryModel;

    /**
     * construct
     *
     * @param FileUploadInterface $image
     */
    public function __construct(
        TreeInterface $tree,
        FileUploadInterface $fileUpload,
        CategoryModel $categoryModel
    ) {
        $this->tree = $tree;
        $this->fileUpload = $fileUpload;
        $this->categoryModel = $categoryModel;
    }

    /**
     * saveReorder
     *
     * @param mixed $tree
     * @param int $parentId
     * @return void
     */
    protected function saveReorder($tree, $parentId = 0)
    {
        foreach ($tree as $key => $item) {
            $foundCategory = $this->categoryModel::find($item['id']);
            $foundCategory->parent_id = $parentId;
            $foundCategory->sort_order = $key;
            $foundCategory->save();
            if (sizeof($item['children']) > 0 ) {
                $this->saveReorder($item['children'], $item['id']);
            }
        }
    }
}
