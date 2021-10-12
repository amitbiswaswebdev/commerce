<?php

namespace Easy\Category\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Easy\Category\Models\Category as CategoryModel;
use Easy\Category\Http\Requests\Category as CategoryRequest;
use Easy\Theme\Contracts\FileUploadInterface;
use Illuminate\Support\Facades\Log;
class Category extends Controller
{
    const BANNER_PATH = 'catalog/category/banner';
    const META_IMAGE_PATH = 'catalog/category/meta_image';

    /**
     * image
     */
    protected FileUploadInterface $fileUpload;

    /**
     * construct
     *
     * @param FileUploadInterface $image
     */
    public function __construct(FileUploadInterface $fileUpload)
    {
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
                'categories'=> CategoryModel::latest()->paginate(10)
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
        $bannerImagePath = (array_key_exists('banner', $inputs)) ? $this->fileUpload->getResizedImagePath($inputs['banner'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
        $metaImagePath = (array_key_exists('meta_image', $inputs)) ? $this->fileUpload->getResizedImagePath($inputs['meta_image'], self::BANNER_PATH, 300) : [$this->fileUpload::NO_FILE_PLACEHOLDER_PATH];
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
                'categories'=> CategoryModel::latest()->paginate(10),
                'category' => CategoryModel::findOrFail($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    // private function getFile(CategoryRequest $request, string $key, string $path) : string
    // {
    //     $inputs = $request->all();
    //     $attribute = $key.'.0.file';
    //     if (array_key_exists($key, $inputs) && $request->hasFile($attribute)) {
    //         $path = $this->fileUpload->storeResizedImage($inputs[$key][0]['file'], $path, 200);
    //     } else {
    //         $path = $this->fileUpload::NO_FILE_PLACEHOLDER_PATH;
    //     }
    //     return $path;
    // }
}
