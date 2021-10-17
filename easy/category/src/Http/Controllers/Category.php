<?php

namespace Easy\Category\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Easy\Category\Models\Category as CategoryModel;
use Easy\Category\Http\Requests\Category as CategoryRequest;
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
     * construct
     *
     * @param FileUploadInterface $image
     */
    public function __construct(
        TreeInterface $tree,
        FileUploadInterface $fileUpload
    ) {
        $this->tree = $tree;
        $this->fileUpload = $fileUpload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Category/Index',[
                'categories'=> $this->tree->getTree(CategoryModel::all()->toArray())
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $inputs = $request->all();
        $bannerImagePath = (array_key_exists('banner', $inputs)) ? $this->fileUpload->createResizedImagePath($inputs['banner'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $metaImagePath = (array_key_exists('meta_image', $inputs)) ? $this->fileUpload->createResizedImagePath($inputs['meta_image'], self::META_IMAGE_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        CategoryModel::create([
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Category/Index',[
                'categories'=> $this->tree->getTree(CategoryModel::all()->toArray()),
                'category' => CategoryModel::findOrFail($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $inputs = $request->all();
        $bannerImagePath = (array_key_exists('banner', $inputs)) ? $this->fileUpload->updateResizedImagePath($inputs['banner'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $metaImagePath = (array_key_exists('meta_image', $inputs)) ? $this->fileUpload->updateResizedImagePath($inputs['meta_image'], self::META_IMAGE_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];

        CategoryModel::where('id', $id)->update([
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
