<?php

// Test XML parsing for the namespace-prefixed XML
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

echo "Raw XML:\n";
echo $xmltext . "\n\n";

// Try to load the XML string
$xmlObject = simplexml_load_string($xmltext, 'SimpleXMLElement', LIBXML_NOCDATA);

if ($xmlObject === false) {
    echo "Failed to parse XML\n";
    exit(1);
}

echo "XML Object:\n";
print_r($xmlObject);

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
    echo "No tns namespace found\n";
    // Fallback to direct conversion if no namespace
    $result = json_decode(json_encode($xmlObject), true);
}

echo "\nParsed result:\n";
print_r($result);

echo "\nFormatted array:\n";
$formatted = [
    'transactionTime' => $result['transactionTime'],
    'transactionID' => $result['transactionID'],
    'sourceNumber' => $result['sourceNumber'],
    'destinationNumber' => $result['destinationNumber'],
    'text' => $result['message'],
    'stage' => $result['stage'],
    'channel' => $result['channel']
];

print_r($formatted);
