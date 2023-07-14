<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Repositories\ReviewRepository;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Requests\ReviewRequest;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class ReviewController extends ParentController
{

    protected $ReviewRepository;
    
    public function __construct(ReviewRepository $ReviewRepository)
    {
        $this->ReviewRepository = $ReviewRepository;
    }
    public function store(ReviewRequest $request)
    {
        try { 
            $this->ReviewRepository->StoreReview($request);

            $this->status = 201;
            $this->success = true;
            $this->message = __("Review added successfully");
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }

    public function PractitionerReview(Request $request)
    {
        try { 
            $practitioner = $this->ReviewRepository->PractitionerReviewData($request);
            $this->status = 200;
            $this->success = true;
            $this->data =  ["review" => $practitioner];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }

    public function PractitionerRating(Request $request)
    {
        try { 
            $rating = $this->ReviewRepository->PractitionerRatingData($request);
            $this->status = 200;
            $this->success = true;
            $this->data =  ["rating" => $rating];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }
    public function practitionerSubCategoryRating(Request $request)
    {
        try { 
            $rating = $this->ReviewRepository->practitionerSubCategoryRating($request);
            $this->status = 200;
            $this->success = true;
            $this->data =  ["rating" => $rating];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }

    public function updateReview(UpdateReviewRequest $request){

        try { 
        $message = $this->ReviewRepository->updateReview($request);
        $this->status = 201;
        $this->success = true;
        $this->message = __($message);
        return $this->apiResponse();
        
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    // get patient review and rating
    public function patientReview(Request $request)
    {
        try { 
           
            $practitioner = $this->ReviewRepository->patientReviewData($request);
            $this->status = 200;
            $this->success = true;
            $this->data =  ["review" => $practitioner];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }

    public function patientRating(Request $request)
    {
        try { 
          
            $rating = $this->ReviewRepository->patientRatingData($request);
            $this->status = 200;
            $this->success = true;
            $this->data =  ["rating" => $rating];
            return $this->apiResponse();
            
            } catch (\Throwable $th) {
                throw $th;
        }
    }
}
