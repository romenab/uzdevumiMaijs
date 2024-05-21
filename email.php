<?php
while (true) {
    $email = trim(strtolower(readline("Enter an email: ")));
    $url = "https://api.emailvalidation.io/v1/info?apikey=ema_live_hAITWIRzRHxW7p2pgdYf2GiniFk0greHDeVvReIJ&email=$email";
    $getContents = json_decode(file_get_contents($url));
    if ($getContents === NULL) {
        echo "Invalid input! Try again." . PHP_EOL;
        continue;
    }
    break;
}
if ($getContents->state !== "deliverable") {
    echo "Invalid email address!" . PHP_EOL;
    exit;
} else {
    echo "Email address is valid!" . PHP_EOL;
}
require 'vendor/autoload.php';
use Mailgun\Mailgun;

$apiKey = getenv("MY_API_KEY");
$domain = getenv("MY_DOMAIN");
$mgClient = Mailgun::create($apiKey);
$params = [
    'from' => 'romenabekere@gmail.com',
    'to' => $email,
    'subject' => 'Hello World',
    'text' => 'Hello World!'
];
try {
    $result = $mgClient->messages()->send($domain, $params);
    echo "Email sent successfully!\n";
} catch (Exception $e) {
    echo "Email failed to send: " . $e->getMessage() . "\n";
}
