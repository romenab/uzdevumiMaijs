<?php
$contents = json_decode(file_get_contents("https://cat-fact.herokuapp.com/facts"));
$count = 1;
foreach ($contents as $content) {
    $facts = $content->text;
    echo "Cat fact Nr.$count: $facts" . PHP_EOL;
    $count++;
}
