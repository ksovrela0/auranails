<?php
session_start();
error_reporting(E_ALL);
include('db.php');
GLOBAL $db;
$db = new dbClass();


$db->setQuery(" SELECT  procedures.id,
                        orders.id AS order_id,
                        orders.client_name,
                        orders.client_phone,
                        orders.write_date,
                        procedures.start_proc,
                        CONCAT(personal.name, ' ', personal.lastname) AS personal_name,
                        `procedure`.name AS proc_name

                FROM    procedures
                JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                JOIN    personal ON personal.id = procedures.user_id
                JOIN    `procedure` ON `procedure`.id = procedures.procedure_id
                WHERE   procedures.actived = 1 AND procedures.send_sms_reminder = 1 AND procedures.is_reminder_sent = 0 AND procedures.status_id = 1  AND procedures.reservation = 0
                        AND (ROUND(UNIX_TIMESTAMP(CONCAT(orders.write_date,' ', procedures.start_proc))) - UNIX_TIMESTAMP()) < 72000
                        AND (ROUND(UNIX_TIMESTAMP(CONCAT(orders.write_date,' ', procedures.start_proc))) - UNIX_TIMESTAMP()) > 68400");



$proceduresWriting = $db->getResultArray();
$db->setQuery(" SELECT  id,
                        temp_name AS title,
                        temp_text AS text

                FROM    sms_templates
                WHERE   id = '3'");

$smsTemp = $db->getResultArray()['result'][0];
foreach($proceduresWriting['result'] AS $procedure){
    $client = explode(' ',$procedure['client_name']);
    $clientName = $client[0];
    $clientLastname = $client[1];

    $tempText = str_replace('{personalName}',$procedure['personal_name'],$smsTemp['text']); //adding personal name
    $tempText = str_replace('{procedureName}',$procedure['proc_name'],$tempText);
    $tempText = str_replace('{procedureDate}',$procedure['write_date'].' '.$procedure['start_proc'],$tempText);
    $tempText = str_replace('{procedureID}',$procedure['id'],$tempText);

    $tempText = str_replace('{clientFirstname}',$clientName,$tempText);
    $tempText = str_replace('{clientLastname}',$clientLastname,$tempText);
    $tempText = str_replace('{clientPhone}',$procedure['client_phone'],$tempText);


    $db->setQuery(" INSERT INTO sms_data (`phone`,`message`,`status`) VALUES ('995$procedure[client_phone]','$tempText','queue')");
    $db->execQuery();

    $db->setQuery("UPDATE procedures SET procedures.is_reminder_sent = 1 WHERE id = '$procedure[id]'");
    $db->execQuery();
}


?>