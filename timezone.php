<?php

$lat = $_GET["a"];
$lon = $_GET["b"];

sleep(2);

$url = "https://us1.locationiq.com/v1/timezone.php?key=8ef4dbf1e87cdd&lat=".$lat."&lon=".$lon;

$fp = fopen ( $url , "r" );

$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {
    $contents .=  $more ;
}

echo $contents ;


?>