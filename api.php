<?php
$api_url = "http://hypertarget.ringrevenue.com/api/2012-06-14/ring_pools/3076/allocate_number.xml?ring_pool_key=AwTakNdOGbjTswKDHhpy1mS6lrY&keyword=&placement=&platform=&lander=&creative=&device=&carrier=&source=";

	$keyword = "&keyword=".$_GET["keyword"];
    $placement = "&placement=".$_GET["placement"];
    $platform = "&platform=".$_GET["platform"];
    $lander = "&lander=".$_GET["lander"];
    $creative = "&creative=".$_GET["creative"];
    $device = "&device=".$_GET["device"];
    $carrier = "&carrier=".$_GET["carrier"];
    $source = "&source=".$_GET["source"];

    $api_url = $api_url.$keyword.$placement.$platform.$lander.$creative.$device.$carrier.$source;

    $response = file_get_contents($api_url);
    $data = new simplexmlelement($response);
    $numf = $data->PromoNumberFormatted[0];
    $num = $data->PromoNumber[0];   
 ?>

