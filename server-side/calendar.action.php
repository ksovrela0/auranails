<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];

switch ($act){
    case 'get_cal_data':
        $date = $_REQUEST['date'];
        $calendar_data = array();

        $db->setQuery(" SELECT  personal.id,
                                CONCAT(personal.name, ' ', personal.lastname) AS fullname
                        FROM    personal

                        WHERE personal.actived = 1 AND DAYOFWEEK('$date') IN (SELECT week_day_id FROM personal_work_days WHERE actived = 1 AND personal_id = personal.id)
                        ORDER BY personal.sort_n ASC");

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
                                    procedures.start_proc AS start_proc,
                                    ROUND(TIME_TO_SEC(procedures.duration)/60) AS duration,
                                    TIME_FORMAT(ADDTIME(procedures.start_proc, procedures.duration), '%H:%i') AS end_proc,
                                    procedure.color
                                                    
                                                    
                            FROM procedures
                            JOIN orders ON orders.id = procedures.order_id AND orders.actived = 1 AND DATE(orders.write_date) = '$date'
                            JOIN `procedure` ON `procedure`.id = procedures.procedure_id
                            WHERE procedures.user_id = '$user[id]' AND procedures.actived = 1 AND procedures.status_id IN (1,2) AND procedures.reservation = 0");

            $procedures = $db->getResultArray();
            $calendar_data[$i]['procedures'] = array();
            foreach($procedures['result'] AS $procedure){
                

                array_push($calendar_data[$i]['procedures'],array(  "order_id" => $procedure['id'],
                                                                    "personal" => $user['fullname'],
                                                                    "procedure_id" => $procedure['proc_id'],
                                                                    "client_name" => $procedure['client_name'],
                                                                    "client_phone" => $procedure['client_phone'],
                                                                    "proc_name" => $procedure['proc_name'],
                                                                    "price" => $procedure['price'],
                                                                    "duration" => $procedure['duration'],
                                                                    "start_proc" => $procedure['start_proc'],
                                                                    "color" => $procedure['color'],
                                                                    "end_proc" => $procedure['end_proc']));
            }

            $i++;
        }


        $data = $calendar_data;

        break;
}

echo json_encode($data);