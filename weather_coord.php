<?php

$lat = $_GET["data1"];
$lon = $_GET["data2"];

sleep(2);

$url = "http://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lon."&units=metric&appid=3d5563ab778ae1cd2429e771f271c6ea";

$fp = fopen ( $url , "r" );

$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {
    $contents .=  $more ;
}

echo $contents ;


?>