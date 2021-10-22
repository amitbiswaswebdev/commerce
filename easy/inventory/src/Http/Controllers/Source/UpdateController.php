<?php

namespace Easy\Category\Http\Controllers;

use Easy\Category\Http\Controllers\Category;
use Easy\Category\Http\Requests\Category as CategoryRequest;

class UpdateController extends Category
{
    /**
     * Handle the incoming request.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CategoryRequest $request, $id)
    {
        $inputs = $request->all();
        $bannerImagePath = (array_key_exists('banner', $inputs)) ? $this->fileUpload->updateResizedImagePath($inputs['banner'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $metaImagePath = (array_key_exists('meta_image', $inputs)) ? $this->fileUpload->updateResizedImagePath($inputs['meta_image'], self::META_IMAGE_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $this->categoryModel::where('id', $id)->update([
            'status' => $inputs['status'],
            'title' => $inputs['title'],
            'slug' => $inputs['slug'],
            'banner' => $bannerImagePath[0],
            'description' => $inputs['description'],
            'meta_image' => $metaImagePath[0],
            'meta_title' => $inputs['meta_title'],
            'meta_description' => $inputs['meta_description']
        ]);
        return redirect()->route('admin.category.index')->with('success', 'Category Successfully updated');
    }
}
