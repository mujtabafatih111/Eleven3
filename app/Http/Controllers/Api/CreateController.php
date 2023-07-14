<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use Illuminate\Http\Request;
use App\Repositories\StoreRepo;
use Illuminate\Support\Facades\DB;

class CreateController extends ParentController
{

    protected $StoreRepo;
    public function __construct(StoreRepo $StoreRepo)
    {
        $this->StoreRepo=$StoreRepo;
    }

    public function create(Request $request){
        try {
            DB::beginTransaction();
            $this->StoreRepo->add($request);
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
        $this->StoreRepo->del($id);
        return response()->json([
            'status'=>true,
            'delete'=>'delete data successfully1',
        ]);
    }

}
