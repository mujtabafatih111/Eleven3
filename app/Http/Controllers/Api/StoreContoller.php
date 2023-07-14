<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Create;
use Illuminate\Support\Facades\DB;

class StoreContoller extends ParentController
{
    protected $Create;

    public function __construct(Create $Create)
    {
        $this->Create = $Create;
    }
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $this->Create->store($request);
            DB::commit();
            $this->status = 201;
            $this->success = true;
            $this->message = __("data created successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
              public function destroy($id){
                $this->Create->delete($id);
                return response()->json([
                    'status'=>true,
                    'delete'=>'delete data successfully1',
                ]);
            }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

}
