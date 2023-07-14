<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Http\Requests\ContactUsRequest;
use App\Jobs\ContactUsEmaillJob;
use Illuminate\Http\Request;

class ContactUsController extends ParentController
{
   public function contactUs(ContactUsRequest $request)
   {
    try { 
        $data = [
            'name' => $request->first_name . $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message
        ];

        dispatch(new ContactUsEmaillJob($data));//send email 

        $this->status = 201;
        $this->success = true;
        $this->message = __("Email sent successfully");
        return $this->apiResponse();
        
        } catch (\Throwable $th) {
            throw $th;
    }
       
   }
}
