<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Jobs\EmailVerificationJob;

use App\Mail\EmailVerification;
use App\Models\User;
use App\Traits\AuthenticateUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProviderRegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Mail;

class AuthController extends ParentController
{
    use AuthenticateUser;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(ProviderRegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->register($request);
            if (!$user) {
                abort(403, 'Unauthorized');
            }
            DB::commit();
            $mailData = [
                'title' => 'Mail from Elev3n site',
                'body' => 'please verify our email to click with this link .',
                'userName' => $user->first_name . ' ' . $user->last_name,
                'verificationUrl' => url('api/verify-email/' . $user->id),
            ];
            $dispa = dispatch(new EmailVerificationJob($mailData, $user)); //send verification email using  job and queue must be run the queue command
            // Mail::to($user->email)->send(new EmailVerification($mailData));  // direct send message
            $apiToken = $user->createToken("API TOKEN")->plainTextToken;
            $this->status = 201;
            $this->success = true;
            $this->message = __("User Register successfully");
            $this->data = ["user" => $user, 'token' => $apiToken];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    // verify email
    public function emailVerify($id)
    {
        try {
            $user = $this->userRepository->verifyEmail($id);

            if ($user) {
                $this->status = 200;
                $this->success = true;
                $this->message = __("Email verified  successfully");
                $this->data = ["user" => $user];
                return $this->apiResponse();
            } else {
                $this->message = __("You'r email is already verified !");
                return $this->apiResponse();
            }

        } catch (\Throwable $th) {
            throw $th;
        }


    }
    public function loginUser(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {

                return $this->error('Credentials do not match', 401);
            }

            if(auth()->user()->email_verified_at == null || auth()->user()->email_verified == 0)
            {
                return $this->error('Your email is not verified !', 401);
            }
            
            $token = auth()->user()->createToken("API TOKEN")->plainTextToken;
            
            $user = User::select('first_name', 'last_name', 'email', 'phone')->find(auth()->user()->id);
            $this->status = 200;
            $this->message = __("User loggedin Successfully");
            $this->data = ["user" =>  $user, "token" => $token];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logoutUser()
    {
        auth()->user()->currentAccessToken()->delete();
        $this->status = 200;
        $this->message = __("User loggedout Successfully");
        return $this->apiResponse();
    }
}