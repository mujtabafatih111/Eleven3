<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use App\Http\Requests\AppointmentBookingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AppointmentController extends ParentController
{
    protected $AppointmentRepository;

    public function __construct(AppointmentRepository $AppointmentRepository)
    {
        $this->AppointmentRepository = $AppointmentRepository;
    }

    public function storeAppointment(AppointmentBookingRequest $request)
    {
        try {
            DB::beginTransaction();
            // Check if the practitioner's date, time, and status are already booked
            $isAlreadyBooked = Appointment::where('practitioner_id', $request->practitioner_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('start_time', $request->start_time)
                ->exists();

            if ($isAlreadyBooked) {
                return response()->json(['message' => 'The appointment is already booked.'], 400);
            }
            $this->AppointmentRepository->create($request);

            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Appointment created successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function cancelAppointment(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->AppointmentRepository->cancel($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            $this->message = __("Appointment cancel successfully");
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function status(Request $request)
    {
      
        try {
            DB::beginTransaction();
           $appointments =  $this->AppointmentRepository->status($request);
            DB::commit();

            $this->status = 201;
            $this->success = true;
            // $this->message = __("Appointment cancel successfully");
            $this->data =  ["appointments" => $appointments];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}