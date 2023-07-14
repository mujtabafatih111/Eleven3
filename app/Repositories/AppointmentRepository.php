<?php
namespace App\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;


class AppointmentRepository
{
    public function create($request)
    {
        $user = auth()->user();
        $appointmentDate = Carbon::createFromFormat('d/m/Y', $request->appointment_date);
        $today = Carbon::today();
        if ($appointmentDate->isFuture()) {
            $status = Appointment::STATUS_UPCOMING;
        } elseif ($appointmentDate->isSameDay($today)) {
            $status = Appointment::STATUS_SCHEDULED;
        } else {
            $status = Appointment::STATUS_PAST;
        }
        Appointment::create([
            'practitioner_id' => $request->practitioner_id,
            'patient_id' => $user->id,
            'practitioner_service_id' => json_encode($request->practitioner_service_id),
            'appointment_date' => $request->appointment_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
            'status' => $status,
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);
    }

    public function cancel($request)
    {
        $user = auth()->user();
        Appointment::whereId($request->appointment_id)->wherePatientId($user->id)->update([
            'status' => Appointment::STATUS_CANCELED,
            'canceled_by' => $user->id

        ]);
    }
    public function status($request)
    {
        $user = auth()->user();

          $appointments = Appointment::where('practitioner_id',$user->id);
          if($request->status == "confirmed")
          {
            return $appointments->where('status',Appointment::STATUS_CONFIRMED)->get();
          }
          if($request->status == "scheduled")
          {
            return $appointments->where('status',Appointment::STATUS_SCHEDULED)->get();
          }
          if($request->status == "canceled")
          {
            return $appointments->where('status',Appointment::STATUS_CANCELED)->get();
          }
          if($request->status == "past")
          {
            return $appointments->where('status',Appointment::STATUS_PAST)->get();
          }
          if($request->status == "upcoming")
          {
            return $appointments->where('status',Appointment::STATUS_UPCOMING)->get();
          }
          if(empty($request->all()))
          {
            return $appointments->get();
          }


    }

}
?>
