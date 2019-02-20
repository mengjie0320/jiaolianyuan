<?php

$image = $_POST['image'];
$image = base64_decode($image);
$image_src = 'image/'.date("Ymdhis").rand(0,9999).'.jpg';
file_put_contents($image_src, $image);
echo $image_src;

?>