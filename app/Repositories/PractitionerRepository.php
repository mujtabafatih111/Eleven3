<?php
namespace App\Repositories;


use App\Models\TwilioAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PractitionerWorkingHour;
use App\Models\PractitionerService;
use App\Models\User;

use GuzzleHttp\Psr7\Request;
use Twilio\Rest\Client;

class PractitionerRepository
{
    public function allPractitioner($request)
    {
        $perPage = 10;
        $featured = $request->featured;
        if ($featured == 1) {
            $practitioner = User::where('featured', 1)->role('practitioner')->with('category.subCategory')->paginate($perPage);
        } else {
            $practitioner = User::role('practitioner')->with('category.subCategory.review')->paginate($perPage);
        }
        return $practitioner;
    }

    public function storeService($request)
    {
        $user = auth()->user();
        return PractitionerService::create([
            'practitioner_id' => $user->id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'cost_per_unit_time' => $request->cost_per_unit_time,
            'remote_availability' => $request->remote_availability,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
    }

    public function getServiceById($id)
    {
        $user = auth()->user();
        $practitionerSerive = PractitionerService::with('category.subCategory')->whereId($id)->where('practitioner_id', $user->id)->first();
        return $practitionerSerive;
    }

    public function updateService($request)
    {
        $user = auth()->user();
        return PractitionerService::whereId($request->practitioner_service_id)->where('practitioner_id', $user->id)->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'cost_per_unit_time' => $request->cost_per_unit_time,
            'remote_availability' => $request->remote_availability,
            'on_demand_availability' => $request->on_demand_availability,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
    }

    public function storeAvailabilityHours($request)
    {
        $user = auth()->user();
        return PractitionerWorkingHour::create([
            'practitioner_id' => $user->id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'general_hour_start' => $request->general_hour_start,
            'general_hour_end' => $request->general_hour_end,
            'exceptional_hour_start' => $request->exceptional_hour_start,
            'exceptional_hour_end' => $request->exceptional_hour_end,
            'specific_service_hour_start' => $request->specific_service_hour_start,
            'specific_service_hour_end' => $request->specific_service_hour_end
        ]);
    }

    public function updateHours($request)
    {
        $user = auth()->user();
        return PractitionerWorkingHour::whereId($request->manage_hour_id)->where('practitioner_id', $user->id)->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'hour_start' => $request->hour_start,
            'hour_end' => $request->hour_end,
            'general_hour_start' => $request->general_hour_start,
            'general_hour_end' => $request->general_hour_end,
            'exceptional_hour_start' => $request->exceptional_hour_start,
            'exceptional_hour_end' => $request->exceptional_hour_end,
            'specific_service_hour_start' => $request->specific_service_hour_start,
            'specific_service_hour_end' => $request->specific_service_hour_end
        ]);
    }

    public function getHourDataById($id)
    {
        $user = auth()->user();
        $workingHour = PractitionerWorkingHour::whereId($id)->where('practitioner_id', $user->id)->first();

        return $workingHour;

    }

    public function allWorkingHour()
    {
        $user = auth()->user();
        $workingHours = PractitionerWorkingHour::where('practitioner_id', $user->id)->get();

        return $workingHours;
    }
    public function storeInfo($request)
    {
        $user = User::find(Auth::user()->id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->category_id = $request->category_id;
        $user->update();

        return $user;
    }

    public function storeLocation($request)
    {
        $user = User::find(Auth::user()->id);

        $user->address = $request->address;
        $user->zip_code = $request->zip_code;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->update();

        return $user;
    }
    public function phoneNumber($request, $twilio_account)
    {
        $user = User::find(Auth::user()->id);

        $phoneVerificationCode = random_int(100000, 999999);
        $user->phone = $request->phone_number;
        $user->country_code = $request->country_code;
        $user->phone_verification_code = $phoneVerificationCode;
        $user->update();

        if ($user) {

            // $sid    = env("TWILIO_ACCOUNT_SID");
            // $token  = env("TWILIO_AUTH_TOKEN");
            // $twilio_phone_number  = env("TWILIO_FROM_NUMBER");
            // dump($sid);
            $twilio_sid = $twilio_account->twilio_account_sid;
            $twilio_auth_token = $twilio_account->twilio_auth_token;
            $twilio_phone_number = $twilio_account->twilio_from;
            $twilio = new Client($twilio_sid, $twilio_auth_token);

            $to = $user->country_code . $user->phone;
                $twilio->messages
                    ->create(
                        $to,
                        // to
                        array(
                            "from" => $twilio_phone_number,
                            "body" => "Verification Code " . $phoneVerificationCode,
                        )
                    );
        }

        return $user;
    }
    public function phoneVerifyCode($request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->phone_verification_code == $request->phone_verify_code) {
            $user->phone_verified = 1;
            $user->update();
        } else {
            return null;
        }

        return $user;
    }
}

?>