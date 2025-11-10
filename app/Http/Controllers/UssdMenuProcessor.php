<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\Facades\Ussd;

class UssdMenuProcessor extends Controller
{
    protected $session;
    protected $userResponse;
    protected $phone_number;
    protected $sessionId;

    public function process(array $request): array
    {
        $this->sessionId = $request['transactionID'];
        $this->phone_number = $request['msisdn'];
        $this->userResponse = trim($request['text']);
        $stage = $request['stage'];

        $ussd = Ussd::machine()->set([
            'phone_number' => $this->phone_number,
            'session_id' => $this->sessionId,
            'input' => $this->userResponse,
            'stage' => $stage,
        ])->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) {
                return [
                    'action' => $action,
                    'message' => $message,
                    'title' => 'MCAZ',
                    'responseExitCode' => 200,
                    'shouldClose' => !($action == 'input')
                ];
            });

        return $ussd->run();

    }
}
