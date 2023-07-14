<?php

namespace App\Http\Controllers\Api\ParentController;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
class ParentController extends Controller
{
    use ResponseTrait;
    use SaveImageTrait;

    protected $userRepository;
    protected $CategoryRepository;
    
   
}
