<?php

$audio = $_POST['audio'];
$audio = base64_decode($audio);
$audio_src = 'record/'.date("Ymdhis").rand(0,9999).'.wmv';
file_put_contents($audio_src, $audio);
echo $audio_src;

?>