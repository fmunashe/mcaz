<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Sparors\Ussd\Facades\Ussd;

class WhatsappBotController extends Controller
{
    public function process(Request $request)
    {
        $request = $request->all();
        $ussd = Ussd::machine()->set([
            'phone_number' => $request['msisdn'],
            'session_id' => $request['transactionID'],
            'input' => trim($request['text']),
        ])->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) {
                return [
                    'title' => 'MCAZ',
                    'message' => $message,
                ];
            });

        return $ussd->run();
    }
}
