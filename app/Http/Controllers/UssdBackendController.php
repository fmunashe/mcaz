<?php

namespace App\Http\Controllers;

use App\CommonData;

class UssdBackendController extends Controller
{
    use CommonData;

    public function process(array $request): array
    {
        $sessionId = $request['sessionId'];
        $msisdn = $request['msisdn'];
        $payload = $request['text'];
        $currentSession = $this->retrieveSession($sessionId, $msisdn);


        $response['message'] = "An error occurred. Please try again.";
        $response['responseExitCode'] = 500;
        $response['shouldClose'] = true;
        return $response;
    }

}
