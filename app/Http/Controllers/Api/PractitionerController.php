<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Models\TwilioAccount;
use App\Repositories\PractitionerRepository;
use App\Http\Requests\ServiceProviderRequest;
use App\Http\Requests\ManageHourRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PractitionerController extends ParentController
{
    protected $PractitionerRepository;

    public function __construct(PractitionerRepository $PractitionerRepository)
    {
        $this->PractitionerRepository = $PractitionerRepository;
    }

    public function allPractitioner(Request $request)
    {
        try {
            $Practitioner = $this->PractitionerRepository->allPractitioner($request);

            $this->status = 200;
            $this->success = true;
            $this->data = ["practitioner" => $Practitioner];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function manageProviderService(ServiceProviderRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->PractitionerRepository->storeService($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Service added successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function getService(Request $request)
    {
        try {
            $practitionerId = $request->practitioner_service_id;
            $practitioner = $this->PractitionerRepository->getServiceById($practitionerId);

            $this->status = 200;
            $this->success = true;
            $this->data = ["practitioner" => $practitioner];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateProviderService(ServiceProviderRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->PractitionerRepository->updateService($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Service updated successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    public function addAvailabilityHours(ManageHourRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->PractitionerRepository->storeAvailabilityHours($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Availability hours added successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function getWorkingHourData(Request $request)
    {
        try {
            $manageHourId = $request->manage_hour_id;

            $workingHour = $this->PractitionerRepository->getHourDataById($manageHourId);

            $this->status = 200;
            $this->success = true;
            $this->data = ["working_hour" => $workingHour];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateAvailabilityHours(ManageHourRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->PractitionerRepository->updateHours($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Availability hours updated successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function practitionerWorkingHours()
    {
        try {
            $workingHours = $this->PractitionerRepository->allWorkingHour();

            $this->status = 200;
            $this->success = true;
            $this->data = ["working_hours" => $workingHours];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function storeInfo(Request $request)
    {
        DB::beginTransaction();
        try {
            $practitioner = $this->PractitionerRepository->storeInfo($request);
            $pract = $practitioner->select('id','first_name','last_name','email','phone')->first();
            DB::commit();
            $this->status = 201;
            $this->success = true;
            $this->message = __("Successfully created user info ..!");
            $this->data = ["practitioner" => $pract];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function storeLocation(Request $request)
    {
        DB::beginTransaction();
        try {

            $practitioner = $this->PractitionerRepository->storeLocation($request);
            $pract = $practitioner->select('id','first_name','last_name','email')->first();
            DB::commit();
            $this->status = 201;
            $this->success = true;
            $this->message = __("Successfully created user location ..!");
            $this->data = ["practitioner" => $pract];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function phoneNumber(Request $request)
    {
        DB::beginTransaction();
        try {
            $twilio_account = TwilioAccount::where('status','active')->first();
            
            if(!$twilio_account)
            {
                return $this->error('Credentials do not match', 401);
            }
            $practitioner = $this->PractitionerRepository->phoneNumber($request,$twilio_account);
            $pract = $practitioner->select('id','first_name','last_name','email')->first();
            DB::commit();
            $this->status = 201;
            $this->success = true;
            $this->message = __("Verification Code sent to given number ...");
            $this->data = ["practitioner" => $pract];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function phoneVerifyCode(Request $request)
    {
        DB::beginTransaction();
        try {
            $practitioner = $this->PractitionerRepository->phoneVerifyCode($request);
            DB::commit();
            if ($practitioner) {
                $this->status = 200;
                $this->success = true;
             
            } else {
                $this->status = 201;
                $this->success = true;
                $this->message = __("Your verification code is not match, Please try again !");

            }
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}