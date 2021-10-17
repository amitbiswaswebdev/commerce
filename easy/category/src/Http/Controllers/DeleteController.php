<?php

namespace Easy\Category\Http\Controllers;

use Inertia\Response;
use Easy\Category\Http\Controllers\Category;
use Easy\Category\Events\CategoryDestroyAfter;

class DeleteController extends Category
{
    /**
     * Delete Category
     *
     * @param int $id
     * @return Response
     */
    public function __invoke($id)
    {
        $category = $this->categoryModel::where('id', $id)->first();
        if ($category->banner != $this->fileUpload::NO_FILE_PLACEHOLDER_PATH && $category->banner != null ) {
            $this->fileUpload->deleteFileFromDirectory($category->banner);
        }
        if ($category->meta_image != $this->fileUpload::NO_FILE_PLACEHOLDER_PATH && $category->meta_image != null ) {
            $this->fileUpload->deleteFileFromDirectory($category->banner);
        }
        $category->delete();
        event(new CategoryDestroyAfter($category));
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');

    }
}
