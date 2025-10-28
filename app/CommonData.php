<?php

namespace App;

use App\Models\UssdSession;

trait CommonData
{
    function retrieveSession($sessionId, $msisdn): UssdSession
    {
        return UssdSession::where('session_id', '=', $sessionId)
            ->where('msisdn', '=', $msisdn)
            ->first();
    }

    function clearSession($sessionId, $msisdn)
    {
        UssdSession::query()->where('session_id', '=', $sessionId)
            ->where('msisdn', '=', $msisdn)
            ->delete();
    }

    function explodePayloadText(UssdSession $ussdSession)
    {
        return explode('*', $ussdSession->payload_text);
    }

    function incrementAndUpdateStage(UssdSession $ussdSession, $payload)
    {
        $stage = $ussdSession->stage;
        $currentPayload = $ussdSession->payload_text;
        $finalPayload = $currentPayload . "*" . $payload;
        if (empty($currentPayload) and !empty($payload) and ($stage == 0 || $stage == 1)) {
            $finalPayload = null;
        }
        if (empty($currentPayload) and $stage == 1) {
            $finalPayload = $payload;
        }


        $ussdSession->stage = ++$stage;
        $ussdSession->payload_text = $finalPayload;

        $ussdSession->save();
    }
}
