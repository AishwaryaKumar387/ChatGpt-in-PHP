<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load constants from a separate configuration file or environment variables if possible
$OPENAI_API_KEY ='API_KEY';
$dTemperature = 0.6;
$iMaxTokens = 2400;
$top_p = 1;
$frequency_penalty = 0.5;
$presence_penalty = 0.5;
$sModel = "text-davinci-003";
//multiple prompts
$propmpt_array =[];

$prompt = "Provide Seo title, Seo Description,Focused Keyword,Tagline,Category and Meta keywords in array format for :
beatXP SmartPlus Prime Weight Machine with BMI & Body Fat Analyzer| Body Composition Scale with 15 Body Parameters | High Precision Sensors & Bluetooth App Sync 18 Months Warranty";


// Initialize curl
$curl = curl_init();
$headers  = [
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer ' . $OPENAI_API_KEY . ''
];

// Set API request parameters
$postData = [
    'model' => $sModel,
    'prompt' => str_replace('"', '', $prompt),
    'temperature' => $dTemperature,
    'max_tokens' => $iMaxTokens,
    'top_p' => $top_p,
    'frequency_penalty' => $frequency_penalty,
    'presence_penalty' => $presence_penalty,
    'stop' => '[" Human:", " AI:"]',
    'seed' => 1234 // Set a fixed seed value for deterministic output
];

// Set curl options
curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));

try {
    // Execute API request
    $result = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        throw new Exception(curl_error($curl));
    }

    // Decode response JSON
    $decoded_json = json_decode($result, true);
    if(isset($decoded_json['choices']))
    {
        // Print generated text
        echo '<pre>';
        print_r($decoded_json['choices'][0]['text']);
        echo '</pre>';
        die();
    }
    elseif(isset($decoded_json['error']))
    {
        // Print generated error text
        print_r($decoded_json['error']['message']);
    }

} catch (Exception $e) {
    // Handle any exceptions
    echo 'Error: ' . $e->getMessage();
} finally {
    // Close curl handle
    curl_close($curl);
}
?>
