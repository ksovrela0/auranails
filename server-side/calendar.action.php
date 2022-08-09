<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];

switch ($act){
    case 'get_cal_data':

        $calendar_data = array();

        $db->setQuery(" SELECT  personal.id,
                                CONCAT(personal.name, ' ', personal.lastname) AS fullname

                        FROM    personal
                        JOIN    procedures ON procedures.user_id = personal.id AND procedures.actived = 1
                        JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1

                        GROUP BY personal.id
                        ORDER BY personal.id ASC");

        $users = $db->getResultArray();
        $i = 0;
        foreach($users['result'] AS $user){
            array_push($calendar_data, array("id" => $user['id'], "name" => $user['fullname']));
            $db->setQuery(" SELECT  orders.id,
                                    procedures.id AS proc_id,
                                    orders.client_name,
                                    orders.client_phone,
                                    procedure.name AS proc_name,
                                    procedures.price,
                                    TIME_FORMAT(IFNULL(ADDTIME(orders.start_proc,(SELECT	SEC_TO_TIME(SUM(TIME_TO_SEC(sum_proc.duration)))
                    
                                                                                            FROM 		procedures AS sum_proc
                    
                                                                                            WHERE 	sum_proc.order_id = orders.id AND sum_proc.id < procedures.id
                                                                                            ORDER BY sum_proc.id ASC)),orders.start_proc), '%H:%i') AS start_proc,
                                    ROUND(TIME_TO_SEC(procedures.duration)/60) AS duration,
                                    TIME_FORMAT(ADDTIME(IFNULL(ADDTIME(orders.start_proc,(SELECT	SEC_TO_TIME(SUM(TIME_TO_SEC(sum_proc.duration)))
                    
                                                                                            FROM 		procedures AS sum_proc
                    
                                                                                            WHERE 	sum_proc.order_id = orders.id AND sum_proc.id < procedures.id
                                                                                            ORDER BY sum_proc.id ASC)),orders.start_proc), procedures.duration), '%H:%i') AS end_proc
                                                    
                                                    
                            FROM procedures
                            JOIN orders ON orders.id = procedures.order_id AND orders.actived = 1
                            JOIN `procedure` ON `procedure`.id = procedures.procedure_id
                            WHERE procedures.user_id = '$user[id]' AND procedures.actived = 1");

            $procedures = $db->getResultArray();
            $calendar_data[$i]['procedures'] = array();
            foreach($procedures['result'] AS $procedure){
                

                array_push($calendar_data[$i]['procedures'],array(  "order_id" => $procedure['id'],
                                                                    "procedure_id" => $procedure['proc_id'],
                                                                    "client_name" => $procedure['client_name'],
                                                                    "client_phone" => $procedure['client_phone'],
                                                                    "proc_name" => $procedure['proc_name'],
                                                                    "price" => $procedure['price'],
                                                                    "duration" => $procedure['duration'],
                                                                    "start_proc" => $procedure['start_proc'],
                                                                    "end_proc" => $procedure['end_proc']));
            }

            $i++;
        }


        $data = $calendar_data;

        break;
}

echo json_encode($data);