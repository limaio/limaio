<?php

$sensor1 = $_GET["s1"];
$sensor2 = $_GET["s2"];
$sensor3 = $_GET["s3"];
$sensor4 = $_GET["s4"];
$sensor5 = $_GET["s5"];
$sensor6 = $_GET["s6"];

$username="root";
$password="6g/5-1R3'-]2|>z";
$database="dal";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

//insert into record_sensores (fechahora,sensor1) values (234234234,"data");
$query = 'INSERT INTO record_sensores2 (fechahora,sensor1,sensor2,sensor3,sensor4,sensor5,sensor6) 
			VALUES (NOW(),"'.$sensor1.'","'.$sensor2.'","'.$sensor3.'","'.$sensor4.'","'.$sensor5.'","'.$sensor6.'")';

$result=mysql_query($query);

if($result){
 print "ok";
}else{
print "error";
}

mysql_close();
?>
