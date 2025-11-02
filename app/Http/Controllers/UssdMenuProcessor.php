<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Sparors\Ussd\Facades\Ussd;

class UssdMenuProcessor extends Controller
{
    protected $session;
    protected $userResponse;
    protected $phone_number;
    protected $sessionId;
    protected $operatorNetwork;

    public function process(Request $request)
    {
        $request = $request->all();
        $this->sessionId = $request['transactionID'];
        $this->phone_number = $request['msisdn'];
        $this->operatorNetwork = $request['networkName'];
        $this->userResponse = trim($request['text']);
//        $stage = $data['stage'] ?? 'MENU_PROCESSING';

        $ussd = Ussd::machine()->set([
            'phone_number' => $this->phone_number,
            'network' => $this->operatorNetwork,
            'session_id' => $this->sessionId,
            'input' => $this->userResponse,
        ])->setInitialState(Welcome::class);
//            ->setResponse(function (string $message, string $action) {
//                return [
//                    'USSDResp' => [
//                        'action' => $action,
//                        'menus' => '',
//                        'title' => $message,
//                    ]
//                ];
//            });

        return response()->json($ussd->run());

//        $ussd = Ussd::machine()
//            ->setFromRequest([
//                'phone_number',
//                'input' => 'user_input',
//                'network',
//                'session_id',
//            ])
//            ->setInitialState(Welcome::class);
//        try {
//            // Parse XML request
//            $xml = simplexml_load_string($request->getContent());
//            $data = json_decode(json_encode($xml), true);
//
//            $this->sessionId = $data['transactionID'];
//            $this->phone = $data['sourceNumber'];
//            $this->userResponse = trim($data['message']);
//            $stage = $data['stage'] ?? 'MENU_PROCESSING';
//
//            // Initialize or retrieve session
//            $this->initializeSession();
//
//            // Process the current menu
//            $response = $this->processMenu();
//
//            // Build and return XML response
//            return $this->buildResponse($response);
//
//        } catch (\Exception $e) {
//            Log::error('USSD Processing Error: ' . $e->getMessage(), [
//                'trace' => $e->getTraceAsString()
//            ]);
//
//            return $this->buildErrorResponse('An error occurred. Please try again later.');
//        }
    }
//
//    protected function initializeSession(): void
//    {
//        $this->session = UssdSession::firstOrCreate(
//            ['session_id' => $this->sessionId],
//            [
//                'msisdn' => $this->phone,
//                'current_menu_id' => 1, // Start with main menu
//                'input_data' => json_encode([
//                    'created_at' => now()->toDateTimeString(),
//                    'last_activity' => now()->toDateTimeString(),
//                    'data' => []
//                ]),
//                'status' => 'active'
//            ]
//        );
//
//        $this->currentMenu = UssdMenu::findOrFail($this->session->current_menu_id);
//        $this->inputData = json_decode($this->session->input_data, true);
//        $this->inputData['last_activity'] = now()->toDateTimeString();
//    }
//
//    protected function processMenu(): array
//    {
//        // Handle empty response (first interaction)
//        if (empty($this->userResponse)) {
//            return [
//                'message' => $this->currentMenu->title,
//                'next_stage' => 'MENU_PROCESSING'
//            ];
//        }
//
//        // Handle menu type specific processing
//        if ($this->currentMenu->type === 'menu') {
//            return $this->handleMenu();
//        }
//
//        if ($this->currentMenu->type === 'input') {
//            return $this->handleInput();
//        }
//
//        if ($this->currentMenu->type === 'end') {
//            return $this->handleEnd();
//        }
//
//        return [
//            'message' => 'Invalid menu type',
//            'next_stage' => 'END',
//            'end_session' => true
//        ];
//    }
//
//    protected function handleMenu(): array
//    {
//        $option = $this->currentMenu->options()
//            ->where('option_number', $this->userResponse)
//            ->first();
//
//        if (!$option) {
//            return [
//                'message' => "Invalid option.\n" . $this->currentMenu->title,
//                'next_stage' => 'MENU_PROCESSING',
//                'next_menu_id' => $this->currentMenu->id
//            ];
//        }
//
//        // Handle role selection
//        if ($this->currentMenu->code === 'REGISTER_ROLE') {
//            $this->inputData['data']['role_id'] = $option->option_number;
//            $this->updateSessionData();
//        }
//
//        // End session if no next menu
//        if (!$option->next_menu_id) {
//            return [
//                'message' => 'Thank you for using our service.',
//                'next_stage' => 'END',
//                'end_session' => true
//            ];
//        }
//
//        $nextMenu = UssdMenu::findOrFail($option->next_menu_id);
//
//        return [
//            'message' => $nextMenu->title,
//            'next_stage' => 'MENU_PROCESSING',
//            'next_menu_id' => $nextMenu->id
//        ];
//    }
//
//    protected function handleInput(): array
//    {
//        $validation = $this->validateInput();
//
//        if (isset($validation['error'])) {
//            return $validation;
//        }
//
//        // Store the validated input
//        $this->inputData['data'][$this->currentMenu->code] = $this->userResponse;
//        $this->updateSessionData();
//
//        // Handle special input cases
//        switch ($this->currentMenu->code) {
//            case 'ACCEPT_TERMS':
//                return $this->handleTermsAcceptance();
//
//            case 'ENTER_OTP':
//                return $this->handleOtpVerification();
//        }
//
//        // Move to next menu
//        if ($this->currentMenu->next_menu_id) {
//            $nextMenu = UssdMenu::findOrFail($this->currentMenu->next_menu_id);
//            return [
//                'message' => $nextMenu->title,
//                'next_stage' => 'MENU_PROCESSING',
//                'next_menu_id' => $nextMenu->id
//            ];
//        }
//
//        return [
//            'message' => 'Thank you for your input.',
//            'next_stage' => 'END',
//            'end_session' => true
//        ];
//    }
//
//    protected function validateInput(): ?array
//    {
//        switch ($this->currentMenu->code) {
//            case 'ENTER_MOBILE':
//                if (!preg_match('/^[0-9]{10,15}$/', $this->userResponse)) {
//                    return [
//                        'message' => 'Invalid mobile number. Please enter a valid 10-15 digit number.',
//                        'next_stage' => 'MENU_PROCESSING',
//                        'next_menu_id' => $this->currentMenu->id
//                    ];
//                }
//                break;
//
//            case 'ENTER_EMAIL':
//                if (!filter_var($this->userResponse, FILTER_VALIDATE_EMAIL)) {
//                    return [
//                        'message' => 'Invalid email address. Please enter a valid email.',
//                        'next_stage' => 'MENU_PROCESSING',
//                        'next_menu_id' => $this->currentMenu->id
//                    ];
//                }
//                break;
//
//            case 'CREATE_PIN':
//                if (!preg_match('/^[0-9]{4}$/', $this->userResponse)) {
//                    return [
//                        'message' => 'PIN must be exactly 4 digits.',
//                        'next_stage' => 'MENU_PROCESSING',
//                        'next_menu_id' => $this->currentMenu->id
//                    ];
//                }
//                $this->inputData['temp_pin'] = $this->userResponse;
//                break;
//
//            case 'CONFIRM_PIN':
//                if (!isset($this->inputData['temp_pin']) || $this->inputData['temp_pin'] !== $this->userResponse) {
//                    return [
//                        'message' => 'PINs do not match. Please try again.',
//                        'next_stage' => 'MENU_PROCESSING',
//                        'next_menu_id' => UssdMenu::where('code', 'CREATE_PIN')->first()->id
//                    ];
//                }
//                $this->inputData['data']['pin'] = $this->userResponse;
//                unset($this->inputData['temp_pin']);
//                break;
//        }
//
//        return null;
//    }
//
//    protected function handleTermsAcceptance(): array
//    {
//        if ($this->userResponse !== '1') {
//            return [
//                'message' => 'You must accept the terms to continue.\n' . $this->currentMenu->title,
//                'next_stage' => 'MENU_PROCESSING',
//                'next_menu_id' => $this->currentMenu->id
//            ];
//        }
//
//        // Generate and store OTP
//        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
//        $this->inputData['otp'] = [
//            'code' => $otp,
//            'attempts' => 0,
//            'expires_at' => now()->addMinutes(10)->toDateTimeString()
//        ];
//        $this->updateSessionData();
//
//        // TODO: Send OTP via SMS/Email
//        // $this->sendOtp($this->inputData['data']['phone'] ?? $this->phone, $otp);
//
//        $nextMenu = UssdMenu::where('code', 'ENTER_OTP')->firstOrFail();
//
//        return [
//            'message' => $nextMenu->title,
//            'next_stage' => 'MENU_PROCESSING',
//            'next_menu_id' => $nextMenu->id
//        ];
//    }
//
//    protected function handleOtpVerification(): array
//    {
//        if (!isset($this->inputData['otp'])) {
//            return $this->endSession('OTP expired or invalid. Please start again.');
//        }
//
//        $otpData = $this->inputData['otp'];
//
//        // Check OTP expiration
//        if (now()->gt(Carbon::parse($otpData['expires_at']))) {
//            return $this->endSession('OTP has expired. Please start again.');
//        }
//
//        // Check OTP attempts
//        if ($otpData['attempts'] >= 3) {
//            return $this->endSession('Maximum OTP attempts exceeded. Please try again later.');
//        }
//
//        // Verify OTP
//        if ($otpData['code'] !== $this->userResponse) {
//            $this->inputData['otp']['attempts']++;
//            $this->updateSessionData();
//
//            $attemptsLeft = 3 - $this->inputData['otp']['attempts'];
//
//            return [
//                'message' => "Incorrect OTP. {$attemptsLeft} attempts remaining.\n" . $this->currentMenu->title,
//                'next_stage' => 'MENU_PROCESSING',
//                'next_menu_id' => $this->currentMenu->id
//            ];
//        }
//
//        // OTP verified, complete registration
//        $this->completeRegistration();
//
//        $successMenu = UssdMenu::where('code', 'REG_SUCCESS')->firstOrFail();
//
//        return [
//            'message' => $successMenu->title,
//            'next_stage' => 'END',
//            'end_session' => true
//        ];
//    }
//
//    protected function completeRegistration(): void
//    {
//        // TODO: Implement user creation logic
//        // $user = User::create([...]);
//
//        // Clear sensitive data
//        unset($this->inputData['otp'], $this->inputData['temp_pin']);
//        $this->updateSessionData();
//
//        // Mark session as completed
//        $this->session->update([
//            'status' => 'completed',
//            'completed_at' => now()
//        ]);
//    }
//
//    protected function handleEnd(): array
//    {
//        $this->session->update([
//            'status' => 'completed',
//            'completed_at' => now()
//        ]);
//
//        return [
//            'message' => $this->currentMenu->title,
//            'next_stage' => 'END',
//            'end_session' => true
//        ];
//    }
//
//    protected function updateSessionData(): void
//    {
//        $this->session->update([
//            'input_data' => $this->inputData,
//            'updated_at' => now()
//        ]);
//    }
//
//    protected function buildResponse(array $response): Response
//    {
//        $nextMenuId = $response['next_menu_id'] ?? $this->currentMenu->id;
//
//        // Update session with next menu if provided
//        if (isset($response['next_menu_id'])) {
//            $this->session->update(['current_menu_id' => $nextMenuId]);
//        }
//
//        // End session if needed
//        if ($response['end_session'] ?? false) {
//            $this->session->update(['status' => 'completed']);
//        }
//
//        // Build XML response
    /*        $xml = '<?xml version="1.0" encoding="UTF-8"?>';*/
//        $xml .= '<messageResponse xmlns="http://econet.co.zw/intergration/messagingSchema">';
//        $xml .= '<transactionTime>' . now()->toIso8601String() . '</transactionTime>';
//        $xml .= '<transactionID>' . $this->sessionId . '</transactionID>';
//        $xml .= '<sourceNumber>' . $this->phone . '</sourceNumber>';
//        $xml .= '<destinationNumber>908</destinationNumber>';
//        $xml .= '<message>' . htmlspecialchars($response['message'], ENT_XML1, 'UTF-8') . '</message>';
//        $xml .= '<stage>' . ($response['next_stage'] ?? 'MENU_PROCESSING') . '</stage>';
//        $xml .= '<channel>USSD</channel>';
//        $xml .= '<applicationTransactionID>MCAZ</applicationTransactionID>';
//        $xml .= '<transactionType>' . (($response['end_session'] ?? false) ? 'COMPLETE' : 'IN_PROGRESS') . '</transactionType>';
//        $xml .= '</messageResponse>';
//
//        return response($xml, 200, [
//            'Content-Type' => 'application/xml',
//            'Cache-Control' => 'no-store, no-cache, must-revalidate',
//            'Pragma' => 'no-cache'
//        ]);
//    }
//
//    protected function buildErrorResponse(string $message): Response
//    {
    /*        $xml = '<?xml version="1.0" encoding="UTF-8"?>';*/
//        $xml .= '<messageResponse>';
//        $xml .= '<transactionTime>' . now()->toIso8601String() . '</transactionTime>';
//        $xml .= '<transactionID>' . ($this->sessionId ?? 'UNKNOWN') . '</transactionID>';
//        $xml .= '<sourceNumber>' . ($this->phone ?? 'UNKNOWN') . '</sourceNumber>';
//        $xml .= '<destinationNumber>908</destinationNumber>';
//        $xml .= '<message>' . htmlspecialchars($message, ENT_XML1, 'UTF-8') . '</message>';
//        $xml .= '<stage>END</stage>';
//        $xml .= '<channel>USSD</channel>';
//        $xml .= '<applicationTransactionID>MCAZ</applicationTransactionID>';
//        $xml .= '<transactionType>COMPLETE</transactionType>';
//        $xml .= '</messageResponse>';
//
//        return response($xml, 200, [
//            'Content-Type' => 'application/xml',
//            'Cache-Control' => 'no-store, no-cache, must-revalidate',
//            'Pragma' => 'no-cache'
//        ]);
//    }
//
//    protected function endSession(string $message): array
//    {
//        $this->session->update(['status' => 'failed']);
//
//        return [
//            'message' => $message,
//            'next_stage' => 'END',
//            'end_session' => true
//        ];
//    }
}
