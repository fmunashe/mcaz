<?php

namespace App\Http\Controllers;

use App\ClearSession;
use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Sparors\Ussd\Facades\Ussd;

class WhatsappBotController extends Controller
{
    use ClearSession;

    public function process(Request $request)
    {
        $data = $request->all();

        if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
            $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
            $messageId = $request['entry'][0]['changes'][0]['value']['messages'][0]['id'];
            $messageArray = ['hi', 'hie'];
            if (in_array($message, $messageArray)) {
                $this->clearSession($message['from']);
            }

            $from = $message['from'];          // WhatsApp user number
            $text = $message['text']['body'];  // Message content
            $ussd = Ussd::machine()->set([
                'phone_number' => $from,
                'session_id' => $from,
                'input' => trim($text),
            ])->setInitialState(Welcome::class)
                ->setResponse(function (string $message, string $action) use ($from, $messageId) {
                    $this->markMessageAsRead($messageId);
                    $this->sendMessage($message, $from);
                    return [
                        'title' => 'MCAZ',
                        'message' => $message,
                    ];
                });

            return $ussd->run();
        }
    }


    private function sendMessage($message, $recipient): void
    {
        $url = env('FACEBOOK_BASE_URL');
        $token = env('FACEBOOK_ACCESS_TOKEN');

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])
            ->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $recipient,
                'type' => 'text',
                'text' => [
                    'preview_url' => true,
                    'body' => $message,
                ],
            ]);
    }

    private function markMessageAsRead(string $messageId): void
    {
        $url = env('FACEBOOK_BASE_URL'); // Should point to .../{phone_number_id}/messages
        $token = env('FACEBOOK_ACCESS_TOKEN');

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $messageId,
        ]);
    }

    public function verify(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $token = env('FACEBOOK_VERIFY_TOKEN');

        if (
            $request->hub_mode === 'subscribe' &&
            $request->hub_verify_token === $token
        ) {
            return response($request->hub_challenge, 200);
        }

        return response('Invalid token', 403);
    }
}
