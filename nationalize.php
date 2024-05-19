<?php
while (true) {
    $name = strtolower(readline("Enter your name: "));
    $age = json_decode(file_get_contents("https://api.agify.io?name=$name"));
    $gender = json_decode(file_get_contents("https://api.genderize.io?name=$name"));
    $nationality = json_decode(file_get_contents("https://api.nationalize.io/?name=$name"));
    if (empty($age->age) || empty($gender->gender) || empty($nationality->country)) {
        echo "Invalid input. Try again!" . PHP_EOL;
        continue;
    }
    break;
}
$name = trim(ucfirst($name));
echo "Name $name is " . $age->age . " years old." . PHP_EOL;
echo "Name $name is " . $gender->gender . " with " . $gender->probability * 100 . "% probability." . PHP_EOL;
echo "Name $name is from " . $nationality->country[0]->country_id . "." . PHP_EOL;
