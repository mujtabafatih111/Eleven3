<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Http\Controllers\Controller;
use App\Repositories\CommonRepository;
use Illuminate\Http\Request;

class CommonController extends ParentController
{
    protected $commonRepository;
    
    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }
    // ============ testimonial ===============//
    public function store(Request $request)
    {
           $testimonial= $this->commonRepository->storeTestimonial($request->all());
            $this->status = 201;
            $this->success = true;
            $this->message = __("Testimonial Added Successfully");
            $this->data = ["testimonial" => $testimonial];
            return $this->apiResponse();
    } 
    public function getTestimonial()
    {
           $testimonials= $this->commonRepository->getTestimonial();
            $this->status = 200;
            $this->success = true;
            $this->message = __("Testimonial Get Successfully");
            $this->data = ["testimonials" => $testimonials];
            return $this->apiResponse();
    } 

    public function updateProfile(Request $request)
    {
        $user= $this->commonRepository->updateProfile($request->all());
        $this->status = 201;
        $this->success = true;
        $this->message = __("Update Profile Successfully");
        $this->data = ["user" => $user];
        return $this->apiResponse();
    }
    public function updateProfilePhoto(Request $request)
    {
    
        $user= $this->commonRepository->updateProfilePhoto($request);
        $this->status = 201;
        $this->success = true;
        $this->message = __("Update Profile Photo Successfully");
        $this->data = ["user" => $user];
        return $this->apiResponse();
    }
}
