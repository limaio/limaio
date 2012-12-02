<?php

$fecha = date("m\\\/d\\\/Y - H:i");

$sensor1 = $_GET["s1"]; //temperatura 
$sensor2 = $_GET["s2"]; //humedad
$sensor3 = $_GET["s3"]; //uv
$sensor4 = $_GET["s4"]; //ruido
$sensor5 = $_GET["s5"]; //gases
$sensor6 = $_GET["s6"]; //polvo

$decibelios = 50;

if ($sensor4 >= 400 && $sensor4 < 450) {
    $decibelios = 50;
} elseif ($sensor4 >= 450 && $sensor4 < 500) {
    $decibelios = 54;
} elseif ($sensor4 >= 500 && $sensor4 < 550) {
    $decibelios = 58;
} elseif ($sensor4 >= 550 && $sensor4 < 600) {
    $decibelios = 62;
} elseif ($sensor4 >= 600 && $sensor4 < 650) {
    $decibelios = 66;
} elseif ($sensor4 >= 650 && $sensor4 < 700) {
    $decibelios = 70;
} elseif ($sensor4 >= 700 && $sensor4 < 750) {
    $decibelios = 73;
} elseif ($sensor4 >= 750 && $sensor4 < 800) {
    $decibelios = 76;
} elseif ($sensor4 >= 800 && $sensor4 < 850) {
    $decibelios = 78.5;
} elseif ($sensor4 >= 850 && $sensor4 < 900) {
    $decibelios = 81;
} elseif ($sensor4 >= 900) {
    $decibelios = 84;
} else {
    $decibelios = 50;
}
//*print $decibelios;
$uv = $sensor3 -35;
if($uv < 0){
    $uv = 0;
}else{
    $uv = round(($uv)*12/22,2);
}

$data_string = '{"type":"input","field_date":{"und":[{"value":{"date":"' . $fecha . '"}}]},"field_temperature":{"und":[{"value":"' . $sensor1 . '"}]},"field_humidity":{"und":[{"value":"' . $sensor2 . '"}]},"field_uv":{"und":[{"value":"' . $uv . '"}]},"field_dust":{"und":[{"value":"' . $sensor6 . '"}]},"field_gases":{"und":[{"value":"' . $sensor5 . '"}]},"field_noise":{"und":[{"value":"' . $decibelios . '"}]},"field_module":{"und":"Escuelab"}}';

$ch = curl_init('http://limaio.innovacion.pe/rest/node');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);

?>