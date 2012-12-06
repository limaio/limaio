<?php

$keyword = $_GET["keyword"];
$content = $_GET["content"];
//print $content;
$args = explode(" ",$content);

$calle = $args[0];
$nro_calle = $args[1];
$distrito = $args[2];

//print $calle;
//print $nro_calle;
//print $distrito;

$username="root";
$password="6g/5-1R3'-]2|>z";
$database="limaio";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = 'select td.name, n.nid as nid
from taxonomy_term_data td
inner join taxonomy_index ti ON td.tid = ti.tid
inner join node n ON n.nid = ti.nid
inner join field_data_field_calle calle ON calle.entity_id = td.tid
INNER JOIN field_data_field_cuadra cuadra ON cuadra.entity_id = td.tid
INNER JOIN field_data_field_distrito distrito ON distrito.entity_id = td.tid
WHERE n.type = "input"
and calle.field_calle_value like "%'.$calle.'%"
and cuadra.field_cuadra_value like "%'.$nro_calle.'%"
and distrito.field_distrito_value like "%'.$distrito.'%"
and calle.entity_type = "taxonomy_term"
and cuadra.entity_type = "taxonomy_term"
and distrito.entity_type = "taxonomy_term"
order by ti.created DESC
limit 1';

//print $query;

$result=mysql_query($query);

$nid = mysql_result($result,0,"nid");



$query2 = 'select n.nid as nid,
from_unixtime(fecha.field_date_value, "%d-%m-%Y %H:%m") as fechahora,
temperatura.field_temperature_value as t,
humedad.field_humidity_value as humedad,
ruido.field_noise_value as ruido,
uv.field_uv_value as uv,
gases.field_gases_value as gases,
dust.field_dust_value as dust
from node n
INNER JOIN field_data_field_date fecha ON fecha.entity_id = n.nid
LEFT JOIN field_data_field_temperature temperatura ON temperatura.entity_id = n.nid
LEFT JOIN field_data_field_humidity humedad ON humedad.entity_id = n.nid
LEFT JOIN field_data_field_noise ruido ON ruido.entity_id = n.nid
LEFT JOIN field_data_field_uv uv ON uv.entity_id = n.nid
LEFT JOIN field_data_field_gases gases ON gases.entity_id = n.nid
LEFT JOIN field_data_field_dust dust ON dust.entity_id = n.nid
WHERE n.type = "input" and n.nid='.$nid;

$result2=mysql_query($query2);

$i = 0;

$id = mysql_result($result2,$i,"nid");
$fechahora = mysql_result($result2,$i,"fechahora");
$t = mysql_result($result2,$i,"t");
$humedad = mysql_result($result2,$i,"humedad");
$ruido = mysql_result($result2,$i,"ruido");
$uv = mysql_result($result2,$i,"uv");
$gases = mysql_result($result2,$i,"gases");
$polvo = mysql_result($result2,$i,"dust");

mysql_close();

print "Temperatura: ".$t."*C. Humedad: ".$humedad."%. Ruido: ".$ruido."dB. Indice UV: ".$uv." Gases:".$gases." Polvo: ".$polvo;

?>