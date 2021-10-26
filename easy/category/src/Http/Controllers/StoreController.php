<?php

namespace Easy\Category\Http\Controllers;

use Easy\Category\Http\Requests\Category as CategoryRequest;
use Illuminate\Http\RedirectResponse;


class StoreController extends Category
{
    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $bannerImagePath = (array_key_exists('banner', $inputs)) ? $this->fileUpload->createResizedImagePath($inputs['banner'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $metaImagePath = (array_key_exists('meta_image', $inputs)) ? $this->fileUpload->createResizedImagePath($inputs['meta_image'], self::META_IMAGE_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $this->categoryModel::create([
            'status' => $inputs['status'],
            'title' => $inputs['title'],
            'slug' => $inputs['slug'],
            'banner' => $bannerImagePath[0],
            'description' => $inputs['description'],
            'meta_image' => $metaImagePath[0],
            'meta_title' => $inputs['meta_title'],
            'meta_description' => $inputs['meta_description']
        ]);
        return redirect()->route('admin.category.index')->with('success', 'New category created');
    }
}
