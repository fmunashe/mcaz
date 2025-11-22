<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Sparors\Ussd\Facades\Ussd;

class WhatsappBotController extends Controller
{
    public function process(Request $request)
    {
        $data = $request->all();

        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];

        $from = $message['from'];          // WhatsApp user number
        $text = $message['text']['body'];  // Message content
        $ussd = Ussd::machine()->set([
            'phone_number' => $from,
            'session_id' => $from,
            'input' => trim($text),
        ])->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) use ($from) {
                $this->sendMessage($message, $from);
                return [
                    'title' => 'MCAZ',
                    'message' => $message,
                ];
            });

        return $ussd->run();
    }

    public function verify(Request $request)
    {
        $token = env('FACEBOOK_ACCESS_TOKEN');

        if (
            $request->hub_mode === 'subscribe' &&
            $request->hub_verify_token === $token
        ) {
            return response($request->hub_challenge, 200);
        }

        return response('Invalid token', 403);
    }
}
