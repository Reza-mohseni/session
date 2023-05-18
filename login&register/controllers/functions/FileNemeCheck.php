<?php
function checkfilename(){
    $json = file_get_contents('controllers/FileNames.json');
   $errorfile = '';

    $addresses = json_decode($json, true);
    foreach ($addresses as $address) {
        if (!file_exists($address)) {
  $errorfile = "فایل های مهم در این پروژه یافت نشد ";
        }
    }
}