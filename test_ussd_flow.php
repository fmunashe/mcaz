<?php

require_once 'vendor/autoload.php';

// Test the complete flow from XML parsing to data mapping
$xmltext = '<?xml version="1.0" encoding="UTF-8"?>
<tns:messageRequest xmlns:tns="http://econet.co.zw/intergration/messagingSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://econet.co.zw/intergration/messagingSchema ussd-router.xsd ">
  <tns:transactionTime>2001-12-31T12:00:00</tns:transactionTime>
  <tns:transactionID>13355545891110</tns:transactionID>
  <tns:sourceNumber>0778234258</tns:sourceNumber>
  <tns:destinationNumber>908</tns:destinationNumber>
  <tns:message>test12</tns:message>
  <tns:stage>FIRST</tns:stage>
  <tns:channel>USSD</tns:channel>
</tns:messageRequest>';

echo "Testing XML parsing and mapping...\n\n";

// Simulate the formatXMLRequest method
$xmlObject = simplexml_load_string($xmltext, 'SimpleXMLElement', LIBXML_NOCDATA);

if ($xmlObject === false) {
    echo "Failed to parse XML\n";
    exit(1);
}

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
}

echo "Parsed XML data:\n";
print_r($result);

// Simulate the mapArrayForUSSD method with additional test data
$dataArray = [
    'shortCode' => '908',
    'networkName' => 'Econet',
    'countryName' => 'Zimbabwe',
    'sourceNumber' => $result['sourceNumber'],
    'text' => $result['message'],
    'transactionID' => $result['transactionID'],
    'stage' => $result['stage']
];

echo "\nMapped array for USSD:\n";
print_r($dataArray);

// Simulate what UssdMenuProcessor expects
$ussdProcessorData = [
    'transactionID' => $dataArray['transactionID'],
    'msisdn' => $dataArray['sourceNumber'],
    'text' => $dataArray['text'],
    'stage' => $dataArray['stage']
];

echo "\nData for UssdMenuProcessor:\n";
print_r($ussdProcessorData);
