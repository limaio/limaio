<?php

$fecha = date("m\\\/d\\\/Y - H:i");

$sensor1 = $_GET["s1"]; //temperatura 
$sensor2 = $_GET["s2"]; //humedad
$sensor3 = $_GET["s3"]; //uv
$sensor4 = $_GET["s4"]; //ruido
$sensor5 = $_GET["s5"]; //gases
$sensor6 = $_GET["s6"]; //polvo

$data_string = '{"type":"input","field_date":{"und":[{"value":{"date":"'.$fecha.'"}}]},"field_temperature":{"und":[{"value":"'.$sensor1.'"}]},"field_humidity":{"und":[{"value":"'.$sensor2.'"}]},"field_uv":{"und":[{"value":"'.$sensor3.'"}]},"field_dust":{"und":[{"value":"'.$sensor4.'"}]},"field_gases":{"und":[{"value":"'.$sensor5.'"}]},"field_noise":{"und":[{"value":"'.$sensor6.'"}]},"field_module":{"und":"San Miguel"}}';
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