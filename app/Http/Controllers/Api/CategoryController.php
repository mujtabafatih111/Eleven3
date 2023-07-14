<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Http\Requests\CategoryStoreRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class CategoryController extends ParentController
{
    protected $CategoryRepository;
    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $category = $this->CategoryRepository->getAll();
            $this->status = 200;
            $this->success = true;
            $this->data =  ["category" => $category];
            return $this->apiResponse();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $imageName = '';
            if ($request->hasFile('image')) {
                $path = 'images';
                $image = $request->image;
                $imageName = $this->saveImage($image , $path);
            }

            $this->CategoryRepository->create($request , $imageName);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Category created successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = $this->CategoryRepository->getById($id);

            $this->status = 200;
            $this->success = true;
            $this->data =  ["category" => $category];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = $this->CategoryRepository->delete($id);

            if( $category == true){
            $this->status = 200;
            $this->success = true;
            $this->message = __("Category deleted successfully.");
            return $this->apiResponse();
        }else{
            return $this->error('Something went wrong.', 401);
        }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
