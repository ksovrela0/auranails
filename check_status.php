<?php
session_start();
error_reporting(E_ALL);
include('db.php');
GLOBAL $db;
$db = new dbClass();


$db->setQuery(" SELECT  procedures.id
				

                FROM    procedures
                JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                WHERE   procedures.actived = 1 AND procedures.reservation = 0 AND procedures.status_id = 1  AND UNIX_TIMESTAMP() > ROUND(UNIX_TIMESTAMP(CONCAT(orders.write_date,' ', ADDTIME(procedures.start_proc,procedures.duration))))");



$proceduresWriting = $db->getResultArray();

foreach($proceduresWriting['result'] AS $proc){
    $db->setQuery("UPDATE procedures SET status_id = 2 WHERE id = '$id'");
    $db->execQuery();
}

?>