<?php

$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
$cars = array("Volvo", "BMW", "Toyota");

echo $txt1 . "<br>";
echo "Study PHP at " . $txt2 . "<br>";
echo "My car is a " . $cars[0];

echo $resulta . "<br>";


$uri = "https://api.openweathermap.org/data/2.5/weather?lat=14.2469023&lon=100.6058911&lang=th&units=metric&appid=bb32ab343bb6e3326f9e1bbd4e4f5d31";
$response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $resulta = $json['name'];
    $resultb = $json['weather'][0]['main'];
    $resultc = $json['weather'][0]['description'];
    $resultd = $json['main']['temp'];
    $resulte = $json['coord']['lon'];



?>
