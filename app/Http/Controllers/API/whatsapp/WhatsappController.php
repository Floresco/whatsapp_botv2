<?php

namespace App\Http\Controllers\API\whatsapp;

use App\Http\Controllers\BaseController;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Storage;

class WhatsappController extends BaseController
{
    use ApiResponseHelpers ;

    public function index()
    {
        return $this->respondWithSuccess();
    }

    public function webhook(Request $request) {

        Storage::put('inputData_'.time().'.txt', file_get_contents('php://input'));

        return $this->respondWithSuccess([]);
    }
}
