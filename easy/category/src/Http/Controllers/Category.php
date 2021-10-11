<?php

namespace Easy\Category\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Easy\Category\Models\Category as CategoryModel;
use Easy\Category\Http\Requests\Category as CategoryRequest;
use Easy\Theme\Contracts\FileUploadInterface;
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
        $bannerImagePath = $this->getFile($request, 'banner', self::BANNER_PATH);
        $metaImagePath = $this->getFile($request, 'meta_image', self::META_IMAGE_PATH);
        CategoryModel::create([
            'status' => $request->status,
            'title' => $request->title,
            'slug' => $request->slug,
            'banner' => $bannerImagePath,
            'description' => $request->description,
            'meta_image' => $metaImagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return redirect()->back()->with('success', 'New category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    private function getFile(CategoryRequest $request, string $key, string $path) : string
    {
        $inputs = $request->all();
        if (array_key_exists($key, $inputs) && $request->hasFile($key)) {
            $path = $this->fileUpload->storeResizedImage($inputs[$key], $path, 200);
        } else {
            $path = $this->fileUpload::NO_FILE_PLACEHOLDER_PATH;
        }
        return $path;
    }
}
