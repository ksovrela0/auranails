<?php
session_start();
error_reporting(E_ALL);
include('db.php');
GLOBAL $db;
$db = new dbClass();


$db->setQuery(" SELECT  id,
                        writing_id,
                        phone,
                        message
                FROM    sms_data
                WHERE   status = 'queue'
                LIMIT 60");



$sms_in_queue = $db->getResultArray();

foreach($sms_in_queue['result'] AS $sms){
    $apikey = '571c38c51589289fde4c41b5a2abaae4aaa051880832ccecfe230cbc1aac1d13';
    $url = 'https://api.gosms.ge/api/sendsms';
    $fields = array(
        'api_key' => $apikey,
        'from' => 'Aura Nails',
        'to' => $sms['phone'],
        'text' => $sms['message']
    );
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $raw = $output;
    $response = json_decode($output, true);

    $db->setQuery("UPDATE sms_data SET  datetime = NOW(),
                                        response = '$raw',
                                        status = 'sent'
                    WHERE id = '$sms[id]'");
    $db->execQuery();
    sleep(1);
}


?>