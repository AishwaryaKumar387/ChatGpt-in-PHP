<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dTemperature = 0.6;
$iMaxTokens = 2000;
$top_p = 1;
$frequency_penalty = 0.5;
$presence_penalty = 0.5;
<<<<<<< HEAD
$OPENAI_API_KEY =  $OPENAI_API_KEY;
$sModel = "text-davinci-003";
$prompt = "Tell me easy caption for hospital service post";
=======
$OPENAI_API_KEY = $OPENAI_API_KEY;
$sModel = "text-davinci-003";
$prompt = "Where is Mohali";
>>>>>>> 48bb3ecb8d0bc7cdb4fb0c2e1a9c85aab1480e28
$ch = curl_init();
$headers  = [
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer ' . $OPENAI_API_KEY . ''
];

$postData = [
    'model' => $sModel,
    'prompt' => str_replace('"', '', $prompt),
    'temperature' => $dTemperature,
    'max_tokens' => $iMaxTokens,
    'top_p' => $top_p,
    'frequency_penalty' => $frequency_penalty,
    'presence_penalty' => $presence_penalty,
    'stop' => '[" Human:", " AI:"]',
];

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

$result = curl_exec($ch);
$decoded_json = json_decode($result, true);
print_r($decoded_json['choices'][0]['text']);

?>
