<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Repositories\SearchRecordRepository;
use Illuminate\Http\Request;

class SearchController extends ParentController
{
    protected $SearchRecordRepository;
    
    public function __construct(SearchRecordRepository $SearchRecordRepository)
    {
        $this->SearchRecordRepository = $SearchRecordRepository;
    }


    public function holisticPractitionerSearch(Request $request)
    {
      
        try { 
            $holisticPractitioner = $this->SearchRecordRepository->search($request);

            $this->status = 200;
            $this->success = true;
            $this->data =  ["practitioner" => $holisticPractitioner];
            return $this->apiResponse();
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function categoryList()
    {
        try { 
            $categories = $this->SearchRecordRepository->categoryList();

            $this->status = 200;
            $this->success = true;
            $this->data =  ["categories" => $categories];
            return $this->apiResponse();
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function searchPractitioner(Request $request)
    {
        try { 
            $searchPractitioner = $this->SearchRecordRepository->Practitionersearch($request);

            $this->status = 200;
            $this->success = true;
            $this->data =  ["practitioner" => $searchPractitioner];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }
}
