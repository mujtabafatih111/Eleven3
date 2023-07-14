<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository
{
    public function create($request)
    {
        $user = User::create([
            //insert record in DB
            'first_name' => $request->first_name,
            'last_name' => $request->first_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'state_issued_id_number' => $request->state_issued_id_number,
            'professional_license_numbers' => $request->professional_license_numbers,
            'professional_associations' => $request->professional_associations,
            'category_id' => $request->category_id,
            'remote_service_offerings' => $request->remote_service_offerings,
            'on_demand_service_offerings' => $request->on_demand_service_offerings,
            'appointment_cancellation_policy' => $request->appointment_cancellation_policy,
            'address' => $request->address,
            'status' => User::STATUS_ACTIVE
        ])->assignRole($request->user_role);
        return $user;
    }


    public function verifyEmail($id)
    {
        
        $user = User::find($id);
        if($user && $user->email_verified == false)
        {
            $user->email_verified_at = now();
            $user->email_verified = true;
            $user->update();
            return $user;
        }
        else
        {
            return null;
        }

        
    }
    public function allUser($slug, $request)
    {

        if ($request->type == 'patient') {
            $data = User::whereHas('roles', function ($query) {
                $query->where('name', 'patient');
            })->get();
        } else if ($request->type == 'practitioner') {
            $data = User::whereHas('roles', function ($query) {
                $query->where('name', 'practitioner');
            })->get();
        }

        return $data;
    }
    public function userPause($slug, $request)
    {
        if ($request->type == 'patient') {
            $data = User::find($request->patient_id)->update([
                'status' => User::STATUS_SUSPENDED
            ]);
        } else if ($request->type == 'practitioner') {
            $data = User::find($request->practitioner_id)->update([
                'status' => User::STATUS_SUSPENDED
            ]);
        }
        
        return $data;
    }
}

?>