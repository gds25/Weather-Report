<?php

$z = $_GET["data1"];
$c = $_GET["data2"];
$s = $_GET["data3"];

sleep(2);


$url = "http://api.openweathermap.org/data/2.5/weather?q=".$z.",".$s.",".$c."&units=metric&appid=3d5563ab778ae1cd2429e771f271c6ea";

$fp = fopen ( $url , "r" );

$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {
    $contents .=  $more ;
}

echo $contents ;


?>