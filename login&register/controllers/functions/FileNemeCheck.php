<?php
checkfilename();
function checkfilename(){
    $json = file_get_contents('../FileNames.json');
    $addresses = json_decode($json, true);

    foreach ($addresses as $address) {
        if (!file_exists($address)) {
            $error = $address . " :متاسفانه فایل های مورد نیاز در مسیر " . "<br>" . "پیدا نشد. ";
        }
    }
}