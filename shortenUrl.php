<?php
while (true) {
    $userUrl = trim(strtolower(readline("Enter url to shorten: ")));
    $url = "https://cleanuri.com/api/v1/shorten";
    $apiUrl = curl_init($url);
    curl_setopt($apiUrl, CURLOPT_POST, true);
    curl_setopt($apiUrl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($apiUrl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    $encoded = json_encode(["url" => $userUrl]);
    curl_setopt($apiUrl, CURLOPT_POSTFIELDS, $encoded);
    $content = curl_exec($apiUrl);
    if (curl_errno($apiUrl)) {
        echo "Error. Try again." . PHP_EOL;
        continue;
    }
    curl_close($apiUrl);
    $shortUrl = json_decode($content);
    if (!isset($shortUrl->result_url)) {
        echo "Error. Try again." . PHP_EOL;
        continue;
    }
    break;
}
echo "Short url: " . $shortUrl->result_url;
