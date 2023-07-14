<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends ParentController
{
  protected $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }
  public function allUser($slug, Request $request)
  {

    try {
      $user = $this->userRepository->allUser($slug, $request);
      $this->status = 200;
      $this->success = true;
      $this->data = [$slug => $user];
      return $this->apiResponse();

    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function userPause($slug, Request $request)
  {

    try {
      $user = $this->userRepository->userPause($slug, $request);
      $this->status = 200;
      $this->success = true;
      $this->message = __("This User Pause successfully");
      $this->data = [$slug => $user];
      return $this->apiResponse();

    } catch (\Throwable $th) {
      throw $th;
    }
  }

}