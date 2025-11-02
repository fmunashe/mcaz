<?php

namespace App;

use App\Models\UssdSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

trait ProtocolHelper
{
    function formatXMLRequest($xmltext): array
    {
        // Try to load the XML string
        $xmlObject = simplexml_load_string($xmltext, 'SimpleXMLElement', LIBXML_NOCDATA);

        // Handle namespaces - get the tns namespace elements
        $result = [];
        if ($xmlObject->children('tns', true)) {
            $tns = $xmlObject->children('tns', true);
            $result['transactionTime'] = (string)$tns->transactionTime;
            $result['transactionID'] = (string)$tns->transactionID;
            $result['sourceNumber'] = (string)$tns->sourceNumber;
            $result['destinationNumber'] = (string)$tns->destinationNumber;
            $result['message'] = (string)$tns->message;
            $result['stage'] = (string)$tns->stage;
            $result['channel'] = (string)$tns->channel;
        } else {
            // Fallback to direct conversion if no namespace
            $result = json_decode(json_encode($xmlObject), true);
        }

        Log::info("=== result is === ", $result);

        return [
            'transactionTime' => $result['transactionTime'],
            'transactionID' => $result['transactionID'],
            'sourceNumber' => $result['sourceNumber'],
            'destinationNumber' => $result['destinationNumber'],
            'text' => $result['message'],
            'stage' => $result['stage'],
            'channel' => $result['channel']
        ];
    }

    function mapArrayForUSSD($data): array
    {
        return [
            'shortCode' => $data['shortCode'],
            'networkName' => $data['networkName'],
            'countryName' => $data['countryName'],
            'msisdn' => $data['sourceNumber'],
            'transactionTime' => $data['transactionTime'],
            'transactionID' => $data['transactionID'],
            'stage' => $data['stage'],
            'channel' => $data['channel'],
            'text' => $data['text']
        ];
    }

    function getUssdSession($data)
    {
        $session = UssdSession::query()
            ->where('session_id', $data['transactionID'])
            ->where('msisdn', $data['sourceNumber'])
            ->first();

        if ($session !== NULL) {
            $session->updated_at = Carbon::now();
            $session->save();
            return $session->session_id;
        } else {
            UssdSession::create([
                'session_id' => $data['transactionID'],
                'msisdn' => $data['sourceNumber'],
                'app_id' => $data['appId'],
                'application_unique_id' => uniqid($data['transactionID']),
                'stage' => 0,
                'payload_text' => null,
            ]);


            return UssdSession::query()
                ->where('session_id', $data['transactionID'])
                ->orderby('created_at', 'DESC')
                ->first()->session_id;
        }

    }
}
