<?php

session_start();

error_reporting(E_ERROR);

include('../db.php');

GLOBAL $db;

$db = new dbClass();

$act = $_REQUEST['act'];

$user_id = $_SESSION['USERID'];



switch ($act){
    case 'get_sms_page_checked':
        $checked_ids = $_REQUEST['checked_ids'];
        $db->setQuery("SELECT DISTINCT phone FROM writings WHERE actived = 1 AND id IN ($checked_ids)");
        $all_getters = $db->getResultArray();
        $data = array('page' => getSMSPage($all_getters));
        break;
    case 'start_sms_checked':
        $message = $_REQUEST['sms_text'];
        $checked_ids = $_REQUEST['checked_ids'];
        $db->setQuery("INSERT INTO sms_data (`phone`,`message`,`status`)
                        SELECT DISTINCT CONCAT('995',phone), '$message', 'queue'FROM writings WHERE actived = 1 AND id IN ($checked_ids)");
        $db->execQuery();

        break;
    case 'get_sms_page_all':
        $db->setQuery("SELECT DISTINCT phone FROM writings WHERE actived = 1");
        $all_getters = $db->getResultArray();
        $data = array('page' => getSMSPage($all_getters));
        break;
    case 'start_sms_all':
        $message = $_REQUEST['sms_text'];
        $db->setQuery("INSERT INTO sms_data (`phone`,`message`,`status`)
                        SELECT DISTINCT CONCAT('995',phone), '$message', 'queue'FROM writings WHERE actived = 1");
        $db->execQuery();

        break;
    case 'get_add_page':

        $id = $_REQUEST['id'];

        $data = array('page' => getPage());

    break;
    case 'find_client':

        $term = $_REQUEST['term'];

        $db->setQuery("SELECT   clients.id,
                                clients.client_name AS value,
                                clients.client_sex,
                                clients.client_phone
                        FROM clients
                        WHERE actived = 1 AND client_name LIKE '%$term%'");

        $data = $db->getResultArray()['result'];

    break;
    case 'get_personal_interest':
        $id = $_REQUEST['id'];
        $db->setQuery("SELECT salary FROM personal WHERE id = '$id' AND actived = 1");

        $data['salary'] = $db->getResultArray()['result'][0]['salary'];
        break;
    case 'get_procedure_data':
        $id = $_REQUEST['id'];
        $db->setQuery(" SELECT *
                        FROM `procedure`
                        WHERE actived = 1  AND id = '$id'");

        $data = $db->getResultArray()['result'][0];

        $opt = '<option value="0">---</option>';

        $db->setQuery("SELECT   id,
                                CONCAT(name,' ',lastname) AS 'name'
                        FROM    personal
                        WHERE   actived = 1 AND id IN (SELECT personal_id FROM procedure_personal WHERE personal_id = personal.id)");
        $cats = $db->getResultArray();
        foreach($cats['result'] AS $cat){
            if($cat[id] == 99999999){
                $opt .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
            }
            else{
                $opt .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
            }
        }

        $data['personal'] = $opt;


        break;
    case 'check_login':
        $login = $_REQUEST['login'];
        $pass = $_REQUEST['password'];

        $db->setQuery(" SELECT  id
                        FROM    users
                        WHERE   username = '$login' AND password = '$pass'");
        $user_data = $db->getResultArray();

        if($user_data['count'] > 0){
            $_SESSION['USERID'] = $user_data['result'][0]['id'];
            $data['status'] = 'OK';
        }
        else{
            $data['status'] = '0';
        }
        
        break;

    case 'destroy_session':

        session_destroy();

        unset($_SESSION['USERID']);

    break;
    case 'get_path_page':
        $id = $_REQUEST['id'];
        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO glasses_paths SET user_id = 1");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM glasses_paths WHERE id='$id'");
            $db->execQuery();
        }
        
        $data = array('page' => getPathPage($id, getPath($id)));
    break;
    case 'get_glass_page':
        $id = $_REQUEST['id'];
        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO products_glasses SET user_id = 1");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM products_glasses WHERE id='$id'");
            $db->execQuery();
        }
        
        $data = array('page' => getGlassPage($id, getGlass($id)));
    break;
    case 'get_product_page':
        $id = $_REQUEST['id'];
        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO procedures SET user_id = 1");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM procedures WHERE id='$id'");
            $db->execQuery();
        }
        
        $data = array('page' => getProductPage($id, getProduct($id)));
    break;

    case 'get_edit_page':

        $id = $_REQUEST['id'];
        $personal_id = $_REQUEST['personal_id'];
        $hour = $_REQUEST['hour'];
        $minute = $_REQUEST['minute'];
        $cal_date = $_REQUEST['cal_date'];

        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO orders SET datetime = NOW()");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM orders WHERE id='$id'");
            $db->execQuery();
        }
        
        $data = array('page' => getPage($id, getWriting($id), $personal_id, $hour, $minute,$cal_date));

    break;
    case 'get_client_page':
        $id = $_REQUEST['id'];
        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO clients SET datetime = NOW()");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM clients WHERE id='$id'");
            $db->execQuery();
        }
        $data = array('page' => getClientPage($id,getClient($id)));
        break;
    case 'get_reserve_from_page':
        $id = $_REQUEST['proc_id'];
        $data = array('page' => getReserveFromPage(getReserve($id)));
        break;
    case 'get_reserve_page':

        /* $id = $_REQUEST['id'];
        $personal_id = $_REQUEST['personal_id'];
        $hour = $_REQUEST['hour'];
        $minute = $_REQUEST['minute'];
        $cal_date = $_REQUEST['cal_date'];

        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO orders SET datetime = NOW()");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM orders WHERE id='$id'");
            $db->execQuery();
        } */
        
        $data = array('page' => getReservePage());

    break;

    case 'copy_writing':

        $id = $_REQUEST['writing_id'];

        

        $db->setQuery(" SELECT 		writings.id,

                                    writings.firstname,

                                    writings.lastname,

                                    writings.sex_id,
                                    
                                    writings.cab_id,

                                    writings.phone,

                                    writings.total_price,

                                    writings.soc_media,

                                    writings.personal_id,

                                    writings.impuls_qty,

                                    writings.status AS status_id

                            

                        FROM 		writings

                        WHERE 		writings.actived = 1 AND writings.id = '$id'



                        ORDER BY 	writings.id DESC");

        $result = $db->getResultArray();



        $res = $result['result'][0];



        $db->setQuery("INSERT INTO writings SET firstname='$res[firstname]',

                                                lastname='$res[lastname]',

                                                sex_id='$res[sex_id]',

                                                phone='$res[phone]',
                                                
                                                cab_id='$res[cab_id]',

                                                soc_media='$res[soc_media]',

                                                write_datetime=NOW(),

                                                personal_id='$res[personal_id]',

                                                total_price='$res[total_price]',

                                                status='$res[status_id]'");

        $db->execQuery();



        $db->setQuery("SELECT MAX(id) as id FROM writings WHERE actived = 1");

        $new_id = $db->getResultArray();

        $new_id = $new_id['result'][0]['id'];



        $db->setQuery(" SELECT  zone_id,

                                impuls_qty

                        FROM    selected_zones

                        WHERE   selected_zones.writing_id = '$id'");

        $copy_zones = $db->getResultArray();



        foreach($copy_zones['result'] AS $zone){

            $db->setQuery("INSERT INTO selected_zones SET   zone_id='$zone[zone_id]',

                                                            impuls_qty='$zone[impuls_qty]',

                                                            writing_id='$new_id'");

            $db->execQuery();

        }

    break;

    case 'reload_impulses':

        $id = $_REQUEST['writing_id'];

        $zones = $_REQUEST['zones'];

        

        foreach($zones AS $zone){

            $db->setQuery(" SELECT      zones.id,

                                        zones.name,

                                        selected_zones.impuls_qty

                            FROM        zones

                            LEFT JOIN   selected_zones ON selected_zones.zone_id = zones.id AND selected_zones.writing_id = '$id'

                            WHERE       zones.id = '$zone'");

            $impuls_data = $db->getResultArray();

            $impuls_data = $impuls_data['result'][0];



            $html .= '  <div class="col-sm-4">

                            <label>'.$impuls_data[name].': </label>

                            <input value="'.$impuls_data[impuls_qty].'" data-nec="0" style="height: 18px; width: 25%;" type="text" id="impuls_'.$impuls_data[id].'" class="impulses" autocomplete="off">

                        </div>';

        }



        $data['automatedChild'] = $html;

    break;

    case 'count_total_money':

        $start  = $_REQUEST['start_date'];

        $end    = $_REQUEST['end_date'];

        

        $db->setQuery(" SELECT  	IFNULL(SUM(writings.total_price),'0,00') AS 'total'

                        FROM    	writings

                        WHERE   	writings.status = 3 AND DATE(writings.visit_datetime) BETWEEN '$start' AND '$end' AND writings.actived=1");

        $total = $db->getResultArray();





        $db->setQuery(" SELECT 	    personal.id,

                                    personal.name,

                                    IFNULL(SUM(writings.total_price),'0,00') AS cc



                        FROM 		personal

                        LEFT JOIN   writings ON writings.personal_id = personal.id AND writings.actived=1 AND writings.`status` = 3 AND DATE(writings.visit_datetime) BETWEEN '$start' AND '$end'

                        WHERE 	    personal.actived = 1

                        GROUP BY    personal.id");

        $personal_cc = $db->getResultArray();

        $data['total'] = $total['result'][0]['total'];

        $data['personal'] = $personal_cc['result'];

    break;

    case 'get_selected_zones_male':

        $db->setQuery("	SELECT 	`id`,

								CONCAT(`name`, '( ',price,' GEL )') AS name

						FROM   	`zones`

						WHERE  	`actived` = 1 AND sex_id = 2");

		$data = $db->getResultArray();

    break;

    case 'get_selected_zones_female':

        $db->setQuery("	SELECT 	`id`,

								CONCAT(`name`, '( ',price,' GEL )') AS name

						FROM   	`zones`

						WHERE  	`actived` = 1 AND sex_id = 1");

		$data = $db->getResultArray();

    break;

    case 'get_selected_zones':

        $id = $_REQUEST['id'];

        $db->setQuery("	SELECT 		GROUP_CONCAT(selected_zones.zone_id) AS zones

                        FROM 		writings

                        LEFT JOIN	selected_zones ON selected_zones.writing_id = writings.id

                        WHERE 		writings.actived = 1 AND writings.id = '$id'");

		$zones = $db->getResultArray();



        $data['selectedZones'] = $zones['result'][0]['zones'];

    break;

    case 'save_order':

        $id             = $_REQUEST['id'];
        $client_name    = $_REQUEST['client_name'];
        $client_phone   = $_REQUEST['client_phone'];
        $client_sex     = $_REQUEST['client_sex'];
        $start_proc    = $_REQUEST['start_proc'];
        $end_proc    = $_REQUEST['end_proc'];
        $order_date     = $_REQUEST['order_date'];
        $client_comment      = $_REQUEST['client_comment'];
        $client_id      = $_REQUEST['client_id'];

        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    orders
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            $db->setQuery("INSERT INTO orders SET
                                                id = '$id',
                                                user_id='$user_id',
                                                datetime=NOW(),
                                                write_date='$order_date',
                                                client_name='$client_name',
                                                comment='$client_comment',
                                                client_phone='$client_phone',
                                                client_sex='$client_sex',
                                                client_id='$client_id',
                                                start_proc='$start_proc',
                                                end_proc='$end_proc'");

            $db->execQuery();
            $data['error'] = '';


            sendSMS('new_writing',$id);
        }

        else{
            $db->setQuery("UPDATE orders SET user_id='$user_id',
                                                write_date='$order_date',
                                                client_name='$client_name',
                                                comment='$client_comment',
                                                client_phone='$client_phone',
                                                client_sex='$client_sex',
                                                client_id='$client_id',
                                                start_proc='$start_proc',
                                                end_proc='$end_proc'
                            WHERE id='$id'");
            $db->execQuery();
            $data['error'] = '';
        }

    break;
    case 'get_list_clients':
        $id          =      $_REQUEST['hidden'];
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];



            $db->setQuery("SELECT 	clients.id,
                                    clients.client_name,
                                    clients.client_phone,
                                    sex.name,
                                    clients.datetime
                                    
                                        
                            FROM 	clients
                            JOIN    sex ON sex.id = clients.client_sex
                            WHERE 	clients.actived = 1");



        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'save_new_client':
        $id             = $_REQUEST['id'];
        $client_name    = $_REQUEST['client_name'];
        $client_phone   = $_REQUEST['client_phone'];
        $client_sex     = $_REQUEST['client_sex'];

        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    clients
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            $db->setQuery("INSERT INTO clients SET
                                                id = '$id',
                                                datetime=NOW(),
                                                client_name='$client_name',
                                                client_phone='$client_phone',
                                                client_sex='$client_sex'");

            $db->execQuery();
            $data['error'] = '';
        }

        else{
            $db->setQuery("UPDATE clients SET   client_name='$client_name',
                                                client_phone='$client_phone',
                                                client_sex='$client_sex'
                            WHERE id='$id'");
            $db->execQuery();
            $data['error'] = '';
        }
        break;
    case 'add_to_reserve':

        $id          = $_REQUEST['proc_id'];
        $order_id    = $_REQUEST['order_id'];
        $procedure_cat_id    = $_REQUEST['procedure_cat_id'];
        $personal_id    = $_REQUEST['personal_id'];
        $duration    = $_REQUEST['duration'].':00';
        $price    = $_REQUEST['price'];
        $salary_percent    = $_REQUEST['salary_percent'];
        $start_proc    = $_REQUEST['start_proc'].':00';

        $order_date    = $_REQUEST['order_date'];

        $db->setQuery(" SELECT  COUNT(*) AS cc,
                                procedures.start_proc,
                                procedures.duration,
                                procedures.user_id
                        FROM    procedures
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();
        
        if($isset['result'][0]['cc'] == 0){
            
            $db->setQuery("INSERT INTO procedures SET   id = '$id',
                                                        user_id='$personal_id',
                                                        datetime=NOW(),
                                                        order_id='$order_id',
                                                        procedure_id='$procedure_cat_id',
                                                        duration='$duration',
                                                        price='$price',
                                                        start_proc='$start_proc',
                                                        salary_percent='$salary_percent',
                                                        reserve_datetime=NOW(),
                                                        reservation = 1");

            $db->execQuery();

            $data['error'] = '';
        }

        else{
            
            $db->setQuery("UPDATE procedures    SET     user_id='$personal_id',
                                                    datetime=NOW(),
                                                    order_id='$order_id',
                                                    procedure_id='$procedure_cat_id',
                                                    duration='$duration',
                                                    price='$price',
                                                    start_proc='$start_proc',
                                                    salary_percent='$salary_percent',
                                                    reserve_datetime=NOW(),
                                                    reservation = 1
                        WHERE id='$id'");

            $db->execQuery();
            $data['error'] = '';
                
            
        }

    break;
    case 'take_from_reserve':
        $id             = $_REQUEST['proc_id'];
        $order_id       = $_REQUEST['order_id'];
        $personal_id    = $_REQUEST['personal_id'];  
        $start_proc     = $_REQUEST['start_proc'];
        $order_date     = $_REQUEST['write_date'];
        $duration     = $_REQUEST['duration'];


        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    procedures
                        JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                        WHERE   procedures.actived = 1 AND procedures.status_id IN (1,2) AND DATE(orders.write_date) = '$order_date' AND procedures.reservation = 0 AND procedures.user_id = '$personal_id'
                        AND     (ADDTIME('$start_proc','00:01') BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                OR ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')) BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                OR procedures.start_proc BETWEEN ADDTIME('$start_proc','00:01') AND ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')))");
        $existedProcedures = $db->getResultArray()['result'][0]['cc'];
        
        if($existedProcedures > 0){

            $data['error'] = 'არჩეულ დროზე პერსონალი დაკავებულია, გთხოვთ მიუთითოთ სხვა დრო';
        }
        else{
            $db->setQuery("UPDATE procedures    SET     user_id='$personal_id',
                                                        datetime=NOW(),
                                                        reservation=0,
                                                        start_proc='$start_proc'
                            WHERE id='$id'");
            $db->execQuery();

            $db->setQuery("UPDATE orders    SET     write_date='$order_date'
                                            WHERE id='$order_id'");
            $db->execQuery();
            $data['error'] = '';
        }


        break;
    case 'save_procedure':

        $id          = $_REQUEST['proc_id'];
        $order_id    = $_REQUEST['order_id'];
        $procedure_cat_id    = $_REQUEST['procedure_cat_id'];
        $personal_id    = $_REQUEST['personal_id'];   
        $price    = $_REQUEST['price'];
        $salary_percent    = $_REQUEST['salary_percent'];
        $order_date    = $_REQUEST['order_date'];

        $start_proc     = $_REQUEST['start_proc'];
        $duration       = $_REQUEST['duration'];

        $db->setQuery(" SELECT  COUNT(*) AS cc,
                                TIME_FORMAT(procedures.start_proc, '%H:%i') AS start_proc,
                                TIME_FORMAT(procedures.duration, '%H:%i') AS duration,
                                procedures.user_id,
                                procedures.reservation
                        FROM    procedures
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            
            $db->setQuery(" SELECT  COUNT(*) AS cc
                            FROM    procedures
                            JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                            WHERE   procedures.actived = 1 AND procedures.status_id IN (1,2) AND DATE(orders.write_date) = '$order_date' AND procedures.reservation = 0 AND procedures.user_id = '$personal_id'
                            AND     (ADDTIME('$start_proc','00:01') BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                    OR ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')) BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                    OR procedures.start_proc BETWEEN ADDTIME('$start_proc','00:01') AND ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')))");
            $existedProcedures = $db->getResultArray()['result'][0]['cc'];
            
            if($existedProcedures > 0){

                $data['error'] = 'არჩეულ დროზე პერსონალი დაკავებულია, გთხოვთ მიუთითოთ სხვა დრო ან ჩაწეროთ რეზერვში. გსურთ ჩაწერის რეზერვში ჩასმა?';
            }
            else{
                $db->setQuery("INSERT INTO procedures SET   id = '$id',
                                                            user_id='$personal_id',
                                                            datetime=NOW(),
                                                            order_id='$order_id',
                                                            procedure_id='$procedure_cat_id',
                                                            duration='$duration',
                                                            price='$price',
                                                            start_proc='$start_proc',
                                                            salary_percent='$salary_percent'");

                $db->execQuery();
                $data['error'] = '';
            }
            
        }

        else{
            if($isset['result'][0]['reservation'] == 1 OR ($start_proc == $isset['result'][0]['start_proc'] && $duration == $isset['result'][0]['duration'] && $personal_id == $isset['result'][0]['user_id'])){
                $db->setQuery("UPDATE procedures    SET     user_id='$personal_id',
                                                            datetime=NOW(),
                                                            order_id='$order_id',
                                                            procedure_id='$procedure_cat_id',
                                                            duration='$duration',
                                                            price='$price',
                                                            start_proc='$start_proc',
                                                            salary_percent='$salary_percent'
                                WHERE id='$id'");
                $db->execQuery();
                $data['error'] = '';
            }
            else{

                $db->setQuery(" SELECT  COUNT(*) AS cc
                                FROM    procedures
                                JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                                WHERE   procedures.actived = 1 AND procedures.status_id IN (1,2) AND DATE(orders.write_date) = '$order_date' AND procedures.reservation = 0 AND procedures.user_id = '$personal_id'
                                AND     (ADDTIME('$start_proc','00:01') BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                        OR ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')) BETWEEN procedures.start_proc AND ADDTIME(procedures.start_proc,procedures.duration) 
                                        OR procedures.start_proc BETWEEN ADDTIME('$start_proc','00:01') AND ADDTIME(ADDTIME('$start_proc','00:01'),TIMEDIFF('$duration','00:01')))");
                $existedProcedures = $db->getResultArray()['result'][0]['cc'];
                
                if($existedProcedures > 0){

                    $data['error'] = 'არჩეულ დროზე პერსონალი დაკავებულია, გთხოვთ მიუთითოთ სხვა დრო ან ჩაწეროთ რეზერვში. გსურთ ჩაწერის რეზერვში ჩასმა?';
                }
                else{
                    $db->setQuery("UPDATE procedures    SET     user_id='$personal_id',
                                                            datetime=NOW(),
                                                            order_id='$order_id',
                                                            procedure_id='$procedure_cat_id',
                                                            duration='$duration',
                                                            price='$price',
                                                            start_proc='$start_proc',
                                                            salary_percent='$salary_percent'
                                WHERE id='$id'");

                    $db->execQuery();
                    $data['error'] = '';

                    sendSMS('change', $id);
                }
                
            }
            
        }

    break;

    case 'save_glass':

        $id             = $_REQUEST['id'];
        $glass_cat    = $_REQUEST['glass_cat'];
        $product_id    = $_REQUEST['product_id'];
        $glass_type   = $_REQUEST['glass_type'];
        $glass_color     = $_REQUEST['glass_color'];
        $glass_status    = $_REQUEST['glass_status'];
        $glass_width     = $_REQUEST['glass_width'];
        $glass_height      = $_REQUEST['glass_height'];

        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    products_glasses
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            $db->setQuery("INSERT INTO products_glasses SET
                                                id = '$id',
                                                user_id='$user_id',
                                                datetime=NOW(),
                                                order_product_id='$product_id',
                                                glass_option_id='$glass_cat',
                                                glass_type_id='$glass_type',
                                                glass_color_id='$glass_color',
                                                glass_width='$glass_width',
                                                glass_height='$glass_height',
                                                status_id='$glass_status'");

            $db->execQuery();
            $data['error'] = '';
        }

        else{
            $db->setQuery("UPDATE products_glasses SET user_id='$user_id',
                                                order_product_id='$product_id',
                                                glass_option_id='$glass_cat',
                                                glass_type_id='$glass_type',
                                                glass_color_id='$glass_color',
                                                glass_width='$glass_width',
                                                glass_height='$glass_height',
                                                status_id='$glass_status'
                            WHERE id='$id'");
            $db->execQuery();
            $data['error'] = '';
        }

    break;

    case 'save_path':

        $id             = $_REQUEST['id'];
        $glass_id    = $_REQUEST['glass_id'];
        $path_group_id    = $_REQUEST['path_group_id'];
        $path_status     = $_REQUEST['path_status'];
        $sort_n    = $_REQUEST['sort_n'];

        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    glasses_paths
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            $db->setQuery("INSERT INTO glasses_paths SET
                                                id = '$id',
                                                user_id='$user_id',
                                                datetime=NOW(),
                                                glass_id='$glass_id',
                                                path_group_id='$path_group_id',
                                                status_id='$path_status',
                                                sort_n='$sort_n'");

            $db->execQuery();
            $data['error'] = '';
        }

        else{
            $db->setQuery("UPDATE glasses_paths SET user_id='$user_id',
                                                glass_id='$glass_id',
                                                path_group_id='$path_group_id',
                                                status_id='$path_status',
                                                sort_n='$sort_n'
                            WHERE id='$id'");
            $db->execQuery();
            $data['error'] = '';
        }

    break;

    case 'disable':

        $ids = $_REQUEST['id'];
        $type = $_REQUEST['type'];

        if($type == 'order'){
            $ids = explode(',',$ids);



            foreach($ids AS $id){
                $db->setQuery("UPDATE orders SET actived = 0 WHERE id = '$id'");
                $db->execQuery();
    
            }
        }
        else if($type == 'product'){
            $ids = explode(',',$ids);



            foreach($ids AS $id){
                $db->setQuery("UPDATE procedures SET actived = 0 WHERE id = '$id'");
                $db->execQuery();
    
            }
        }

        else if($type == 'procedure'){

            $db->setQuery("UPDATE procedures SET status_id = 3 WHERE id = '$ids'");
            $db->execQuery();
            

            $db->setQuery(" SELECT  COUNT(*) AS cc
                            FROM    procedures
                            WHERE   procedures.actived = 1 AND procedures.reservation = 1 AND procedures.status_id = 1");

            $data['reserve_procedures'] = (int)$db->getResultArray()['result'][0]['cc'];

            sendSMS('cancel', $ids);

        }

        else if($type == 'glass'){
            $ids = explode(',',$ids);



            foreach($ids AS $id){
                $db->setQuery("UPDATE products_glasses SET actived = 0 WHERE id = '$id'");
                $db->execQuery();
    
            }
        }
        else if($type == 'path'){
            $ids = explode(',',$ids);



            foreach($ids AS $id){
                $db->setQuery("UPDATE glasses_paths SET actived = 0 WHERE id = '$id'");
                $db->execQuery();
    
            }
        }
        

    break;

    case 'get_columns':

        $columnCount = 		$_REQUEST['count'];

        $cols[] =           $_REQUEST['cols'];

        $columnNames[] = 	$_REQUEST['names'];

        $operators[] = 		$_REQUEST['operators'];

        $selectors[] = 		$_REQUEST['selectors'];

        //$query = "SHOW COLUMNS FROM $tableName";

        //$db->setQuery($query,$tableName);

        //$res = $db->getResultArray();

        $f=0;

        foreach($cols[0] AS $col)

        {

            $column = explode(':',$col);



            $res[$f]['Field'] = $column[0];

            $res[$f]['type'] = $column[1];

            $f++;

        }

        $i = 0;

        $columns = array();

        foreach($res AS $item)

        {

            $columns[$i] = $item['Field'];

            $i++;

        }

        

        $dat = array();

        $a = 0;

        for($j = 0;$j<$columnCount;$j++)

        {

            if(1==2)

			{

				continue;

            }

            else{

                

                if($operators[0][$a] == 1) $op = true; else $op = false; //  TRANSFORMS 0 OR 1 TO True or False FOR OPERATORS

                //$op = false;

                if($res['data_type'][$j] == 'date')

                {

                    $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'format'=>"{0:yyyy-MM-dd hh:mm:ss}",'parseFormats' =>["MM/dd/yyyy h:mm:ss"]);

                }

                else if($selectors[0][$a] != '0') // GETTING SELECTORS WHERE VALUES ARE TABLE NAMES

                {

                    $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'values'=>getSelectors($selectors[0][$a]));

                }

                else

                {

					if($columns[$j] == "inc_status"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 153);

					}elseif($columns[$j] == "audio_file"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 150);

					}elseif($columns[$j] == "action_given"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => '5%');

					}elseif($columns[$j] == "write_date" OR $columns[$j] == "impuls_qty" ){

						$g = array('field'=>$columns[$j], 'hidden' => true,'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 100);

					}
                    elseif($columns[$j] == "id2" OR $columns[$j] == "price"){
                        $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 60);
                    }
                    elseif($columns[$j] == 'sms_stat' OR $columns[$j] == 'sms_date' OR $columns[$j] == 'sms_phone' ){
                        $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 150);
                    }
                    elseif($columns[$j] == "inc_date"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 130);

					}
                    elseif($columns[$j] == "glass_count"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 400);

					}
                    elseif($columns[$j] == "name_product"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 130);

					}
                    elseif($columns[$j] == "sort_n"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 70);

					}
                    elseif($columns[$j] == "proccess2"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 300);

					}
                    elseif($columns[$j] == "id"){

						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 80);

					}
                    else{

                    	$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true));

					}

                }

                $a++;

            }

            array_push($dat,$g);

            

        }

        

        // array_push($dat,array('command'=>["edit","destroy"],'title'=>'&nbsp;','width'=>'250px'));

        

        $new_data = array();

        //{"id":"id","fields":[{"id":{"editable":true,"type":"number"}},{"reg_date":{"editable":true,"type":"number"}},{"name":{"editable":true,"type":"number"}},{"surname":{"editable":true,"type":"number"}},{"age":{"editable":true,"type":"number"}}]}

        for($j=0;$j<$columnCount;$j++)

        {

            if($res['data_type'][$j] == 'date')

            {

                $new_data[$columns[$j]] = array('editable'=>false,'type'=>'string');

            }

            else

            {

                $new_data[$columns[$j]] = array('editable' => true, 'type' => 'string');

            }

        }

        

        $filtArr = array('fields'=>$new_data);

        $kendoData = array('columnss'=>$dat,'modelss'=>$filtArr);

        

        //$dat = array('command'=>["edit","destroy"],'title'=>'&nbsp;','width'=>'250px');

        

        $data = $kendoData;

        //$data = '[{"gg":"sd","ads":"213123"}]';

        

    break;

    case 'get_list':

        $id          =      $_REQUEST['hidden'];

		

        $columnCount = 		$_REQUEST['count'];

		$cols[]      =      $_REQUEST['cols'];



            $db->setQuery("SELECT 	orders.id,
                                    orders.write_date,
                                    orders.client_name,
                                    sex.name,
                                    orders.client_phone,
                                    '' AS proced,
                                    '' AS total_pay,
                                    CONCAT(order_status.name, 
                                    CASE
                                        WHEN orders.status_id = 1 THEN '<div class=\"red_dot\"></div>'
                                        WHEN orders.status_id = 2 THEN '<div class=\"yellow_dot\"></div>'
                                        WHEN orders.status_id = 3 THEN '<div class=\"mid_yellow_dot\"></div>'
                                        WHEN orders.status_id = 4 THEN '<div class=\"green_dot\"></div>'
                                        WHEN orders.status_id = 5 THEN '<div class=\"red_dot\"></div>'
                                    END)
                                    
                                        
                            FROM 	orders
                            JOIN	order_status ON order_status.id = orders.status_id
                            JOIN    sex ON sex.id = orders.client_sex
                            WHERE 	orders.actived = 1");



        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;

    break;
    case 'get_list_sms_history':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $db->setQuery(" SELECT id, phone, datetime,status,message
                        FROM sms_data
                        ORDER BY id DESC
                        ");
        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_proccess':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $order_id = $_REQUEST['order_id'];

        $db->setQuery(" SELECT	products_glasses.id,
                                glass_options.name AS option,
                                glass_type.name AS type,
                                glass_colors.name AS color,
                                products_glasses.glass_width,
                                products_glasses.glass_height,
                                glasses_paths.pyramid,
                                CONCAT('<span style=\"padding:5px;', CASE
                                    WHEN glass_status.id = 1 THEN 'background-color: red;'
                                    WHEN glass_status.id = 2 THEN 'background-color: yellow;'
                                    WHEN glass_status.id = 3 THEN 'background-color: green;'
                                    WHEN glass_status.id = 4 THEN 'background-color: red;'
                                    WHEN glass_status.id = 5 THEN 'background-color: red;'
                                END
                                ,'\">', glass_status.name,'</span>') AS glasses,
                                '<div id=\"new_glass\">დაწყება</div><div id=\"copy_glass\">დასრულება</div><div id=\"del_glass\"> დახარვეზება</div>' AS act
                                
                        FROM 		products_glasses
                        JOIN		orders_product ON orders_product.id = products_glasses.order_product_id
                        JOIN		orders ON orders.id = orders_product.order_id
                        JOIN		glass_options ON glass_options.id = products_glasses.glass_option_id		
                        JOIN 		glass_type ON glass_type.id = products_glasses.glass_type_id
                        JOIN		glass_colors ON glass_colors.id = products_glasses.glass_color_id
                        JOIN		glasses_paths ON glasses_paths.glass_id = products_glasses.id
                        JOIN		glass_status ON glass_status.id = products_glasses.status_id
                        WHERE 	products_glasses.actived = 1

                        GROUP BY products_glasses.id");
        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_reserve':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $order_id = $_REQUEST['order_id'];

        $db->setQuery("SELECT	procedures.id,
                                `orders`.client_name,
                                `orders`.client_phone,
                                IF(`orders`.client_sex = 1,'ქალი', 'კაცი'),
                                `procedure`.name,
                                CONCAT(personal.name, ' ', personal.lastname) AS name,
                                procedures.reserve_datetime,
                                `orders`.write_date,
                                CONCAT(procedures.start_proc,'-', ADDTIME(procedures.start_proc,procedures.duration))
                                

                        FROM 		procedures
                        JOIN		`procedure` ON `procedure`.id = procedures.procedure_id
                        JOIN		personal ON personal.id = procedures.user_id
                        JOIN        order_status ON order_status.id = procedures.status_id
                        JOIN        orders ON orders.id = procedures.order_id AND orders.actived = 1
                        WHERE 	procedures.actived = 1 AND procedures.reservation = 1 AND procedures.status_id = 1
                        ORDER BY procedures.id");
        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_product':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $order_id = $_REQUEST['order_id'];

        $db->setQuery("SELECT	procedures.id,
                                `procedure`.name,
                                `procedures`.start_proc,
                                `procedures`.duration,
                                CONCAT(personal.name, ' ', personal.lastname) AS name,
                                procedures.price,
                                IF(procedures.reservation = 1,'<p style=\"color:red;margin:0;\">რეზერვში</p>','არა'),
                                order_status.name,
                                IF(procedures.status_id = 1,CONCAT('<div data-id=\"',procedures.id,'\" class=\"del_procedure\"> გაუქმება</div>'),'')

                        FROM 		procedures
                        JOIN		`procedure` ON `procedure`.id = procedures.procedure_id
                        JOIN		personal ON personal.id = procedures.user_id
                        JOIN        order_status ON order_status.id = procedures.status_id
                        WHERE 	procedures.actived = 1 AND procedures.order_id = '$order_id'
                        ORDER BY procedures.id");
        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_glasses':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $product_id = $_REQUEST['product_id'];

        $db->setQuery(" SELECT  products_glasses.id,
                                glass_options.name,
                                CONCAT(products_glasses.glass_width, 'სმ X ', products_glasses.glass_height,'სმ'),
                                glass_type.name,
                                glass_colors.name,
                                GROUP_CONCAT(CONCAT(groups.name, ' - <span style=\"color:#000;',
                                CASE
                                    WHEN glasses_paths.status_id = 1 THEN 'background-color: red;'
                                    WHEN glasses_paths.status_id = 2 THEN 'background-color: yellow;'
                                    WHEN glasses_paths.status_id = 3 THEN 'background-color: green;'
                                    WHEN glasses_paths.status_id = 4 THEN 'background-color: red;'
                                    WHEN glasses_paths.status_id = 5 THEN 'background-color: red;'
                                END
                                ,'\">', path_status.name,'</span>') SEPARATOR ',<br>') AS proccess,
                                CONCAT('<span style=\"padding:5px;', CASE
                                    WHEN glass_status.id = 1 THEN 'background-color: red;'
                                    WHEN glass_status.id = 2 THEN 'background-color: yellow;'
                                    WHEN glass_status.id = 3 THEN 'background-color: green;'
                                    WHEN glass_status.id = 4 THEN 'background-color: red;'
                                    WHEN glass_status.id = 5 THEN 'background-color: red;'
                                END
                                ,'\">', glass_status.name,'</span>') AS glasses

                        FROM    products_glasses
                        JOIN    glass_options ON glass_options.id = products_glasses.glass_option_id
                        JOIN    glass_type ON glass_type.id = products_glasses.glass_type_id
                        JOIN    glass_colors ON glass_colors.id = products_glasses.glass_color_id
                        JOIN    glass_status ON glass_status.id = products_glasses.status_id
                        LEFT JOIN	glasses_paths ON glasses_paths.glass_id = products_glasses.id
                        LEFT JOIN groups ON groups.id = glasses_paths.path_group_id
                        LEFT JOIN glass_status AS path_status ON path_status.id = glasses_paths.status_id
                        WHERE   products_glasses.actived = 1 AND products_glasses.order_product_id = '$product_id'
                        GROUP BY products_glasses.id
                        ORDER BY products_glasses.id");


        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_list_glasses_path':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $glass_id = $_REQUEST['glass_id'];

        $db->setQuery(" SELECT  glasses_paths.id,
                                groups.name,
                                glasses_paths.sort_n,
                                CONCAT('<span style=\"padding:5px;', CASE
                                    WHEN glass_status.id = 1 THEN 'background-color: red;'
                                    WHEN glass_status.id = 2 THEN 'background-color: yellow;'
                                    WHEN glass_status.id = 3 THEN 'background-color: green;'
                                    WHEN glass_status.id = 4 THEN 'background-color: red;'
                                    WHEN glass_status.id = 5 THEN 'background-color: red;'
                                END
                                ,'\">', glass_status.name,'</span>') AS glasses

                        FROM    glasses_paths
                        JOIN    groups ON groups.id = glasses_paths.path_group_id
                        JOIN    glass_status ON glass_status.id = glasses_paths.status_id
                        WHERE   glasses_paths.actived = 1 AND glasses_paths.glass_id = '$glass_id'
                        ORDER BY glasses_paths.sort_n ASC");


        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
}





echo json_encode($data);


function getSMSPage($res = ''){
    GLOBAL $db;
    $data .= '

    

    

    <fieldset class="fieldset">
        <legend>შეავსეთ გასაგზავნი ტექსტი (მაქსიმუმ 160 სიმბოლო)</legend>
        <div calss="col-md-12"> 
            <p>უნიკალური ადრესატი ჯამში: <b style="color:red;">'.$res['count'].'</b></p>
            <textarea id="sms_message" style="width:100%" maxlength="160"></textarea>
        </div>
    </fieldset>

    

    <input type="hidden" id="writing_id" value="'.$res[id].'">

    ';



    return $data;
}
function getPath($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            user_id,
                            glass_id,
                            path_group_id,
                            status_id,
                            sort_n
                    FROM    glasses_paths
                    WHERE   id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];
}
function getGlass($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            glass_option_id,
                            glass_type_id,
                            glass_color_id,
                            glass_width,
                            glass_height,
                            status_id
                    FROM    products_glasses
                    WHERE   id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];
    
}
function getGlassPage($id, $res = ''){
    GLOBAL $db;
    
    $data = '   <fieldset class="fieldset">
                    <legend>ინფორმაცია</legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>აირჩიეთ შუშა</label>
                                <select id="selected_glass_cat_id">
                                    '.getGlassOptions($res['glass_option_id']).'
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>შეიყვანეთ ზომა (სიგრძეXსიგანე)</label>
                                <div class="row">
                                    <div class="col-sm-6"><input style="width:99%;" type="text" id="glass_width" value="'.$res['glass_width'].'"></div>
                                    <div class="col-sm-6"><input style="width:99%;" type="text" id="glass_height" value="'.$res['glass_height'].'"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>აირჩიეთ ტიპი</label>
                                <select id="selected_glass_type_id">
                                    '.getGlassTypeOptions($res['glass_type_id']).'
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>აირჩიეთ ფერი</label>
                                <select id="selected_glass_color_id">
                                    '.getGlassColorOptions($res['glass_color_id']).'
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>აირჩიეთ სტატუსი</label>
                                <select id="selected_glass_status">
                                    '.getGlassStatusOptions($res['status_id']).'
                                </select>
                            </div>
                            <div style="margin-top: 16px;" class="col-sm-12">
                                <div id="path_div"></div>
                            </div>
                        </div>
                    </legend>
                </fieldset>

                <input type="hidden" id="glass_id" value="'.$id.'">

                ';

    return $data;
}

function getPathPage($id, $res = ''){
    GLOBAL $db;
    
    $data = '   <fieldset class="fieldset">
                    <legend>ინფორმაცია</legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>აირჩიეთ პროცესი</label>
                                <select id="path_group_id">
                                    '.getPathOptions($res['path_group_id']).'
                                </select>
                            </div>
                            
                            <div class="col-sm-4">
                                <label>აირჩიეთ სტატუსი</label>
                                <select id="path_status">
                                    '.getGlassStatusOptions($res['status_id']).'
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>თანმიმდევრობა</label>
                                <input style="width:99%;" type="text" id="sort_n" value="'.$res['sort_n'].'">
                            </div>
                        </div>
                    </legend>
                </fieldset>

                <input type="hidden" id="path_id" value="'.$id.'">

                ';

    return $data;
}
function getProduct($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            procedure_id,
                            duration,
                            start_proc,
                            TIME_FORMAT(procedures.start_proc, '%H:%i') AS start_proc,
                            TIME_FORMAT(procedures.duration, '%H:%i') AS duration,
                            price,
                            salary_fix,
                            salary_percent,
                            comment,
                            user_id
                    FROM    procedures
                    WHERE   id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];
    
}
function getProductPage($id, $res = ''){
    GLOBAL $db;
    

    $data = '   <fieldset class="fieldset">
                    <legend>ინფორმაცია</legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>აირჩიეთ პროცედურა</label>
                                <select id="procedure_cat">
                                    '.getProductOptions($res['procedure_id']).'
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>აირჩიეთ შემსრულებელი</label>
                                <select id="personal_id">';
                                if($res['user_id'] != ''){
                                    $data .= getPersonalData($res['user_id']);
                                }    
                                
                                $data .= '</select>
                            </div>
                            <div class="col-sm-4">
                                <label>დაწყების დრო</label>
                                <input value="'.$res['start_proc'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="procedure_start" class="idle" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label>ხანგძლივობა</label>
                                <input value="'.$res['duration'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="duration" class="idle" autocomplete="off">
                            </div>

                            <div class="col-sm-4">
                                <label>ფასი</label>
                                <input value="'.$res['price'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="price" class="idle" autocomplete="off">
                            </div>

                            <div class="col-sm-4">
                                <label>ხელფასი %</label>
                                <input value="'.$res['salary_percent'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="salary_percent" class="idle" autocomplete="off">
                            </div>

                            
                        </div>
                    </legend>
                </fieldset>

                <input type="hidden" id="procedure_id" value="'.$id.'">

                ';

    return $data;
}

function getGlassStatusOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    glass_status
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getGlassColorOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    glass_colors
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getGlassTypeOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    glass_type
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getGlassOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    glass_options 
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getPathOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    groups 
                    WHERE actived = 1 AND id != '1'");
    $cats = $db->getResultArray();
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getProductOptions($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            name AS 'name'
                    FROM    `procedure` 
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    $data .= '<option value="0">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getPersonalData($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            CONCAT(name, ' ', lastname) AS 'name'
                    FROM    `personal` 
                    WHERE actived = 1");
    $cats = $db->getResultArray();
    $data .= '<option value="0">აირჩიეთ</option>';
    foreach($cats['result'] AS $cat){
        if($cat[id] == $id){
            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';
        }
        else{
            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';
        }
    }
    return $data;
}
function getClient($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            client_name,
                            client_sex,
                            client_phone

                    FROM    clients
                    WHERE   id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];
}
function getReserveFromPage($res = ''){
    GLOBAL $db;

    $data .= '

    <fieldset class="fieldset">
        <legend>რეზერვი</legend>
        <div class="row">
            <div class="col-sm-6">
                <label>აირჩიეთ შემსრულებელი</label>
                <select id="personal_id_reserve">';
                $data .= getPersonalData($res['user_id']);
                $data .= '</select>
            </div>
            <div class="col-sm-6">
                <label>ჩაწერის თარიღი</label>
                <input value="'.$res['write_date'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="write_date_reserve" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-6">
                <label>დაწყების დრო</label>
                <input value="'.$res['start_proc'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="start_proc_reserve" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    <input type="hidden" id="proc_id_reserve" value="'.$res['id'].'">
    <input type="hidden" id="duration_reserve" value="'.$res['duration'].'">
    <input type="hidden" id="order_id_reserve" value="'.$res['order_id'].'">
    ';



    return $data;
}
function getClientPage($id,$res = ''){
    GLOBAL $db;

    $data .= '

    <fieldset class="fieldset">
        <legend>რეზერვი</legend>
        <div class="row">
            <div class="col-sm-4">
                <label>სახელი გვარი</label>
                <input value="'.$res['client_name'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="client_name_new" class="idle" autocomplete="off"> 
            </div>

            <div class="col-sm-4">
                <label>სქესი</label>
                <select id="client_sex_new">
                    '.getSex($res['client_sex']).'
                </select>
            </div>

            <div class="col-sm-4">
                <label>ტელეფონი</label>
                <input value="'.$res['client_phone'].'" data-nec="0" style="height: 18px; width: 95%;" type="number" oninput="maxLengthCheck(this)" maxLength="9" id="client_phone_new" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    <input type="hidden" id="new_client_id" value="'.$id.'">
    ';



    return $data;
}
function getReservePage(){
    GLOBAL $db;

    $data .= '

    <fieldset class="fieldset">
        <legend>რეზერვი</legend>
        <div class="row">
            <div class="col-sm-12">
                <div id="reserve_div"></div>
            </div>';
        $data .= '</div>

    </fieldset>

    ';



    return $data;
}
function getPage($id, $res = '',$personal_id = '', $hour = '', $minute = '', $cal_date = ''){

    GLOBAL $db;

    $male_checked = '';

    $female_checked = '';

    if($res['sex_id'] == 1){

        $female_checked = 'checked';

    }

    else if($res['sex_id'] == 2){

        $male_checked = 'checked';

    }
    $datetime = $res['datetime'];
    if($res['write_date'] == ''){
        $datetime = $cal_date;
    }

    

    $data .= '

    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-3">
                <label>სახელი გვარი</label>
                <span style="display: flex;flex-direction: row;place-items: center;gap: 10px;">
                    <input value="'.$res['client_name'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="client_name" class="idle" autocomplete="off"> 
                    <img id="add_new_client" src="assets/img/new.png" style="width:20px;cursor:pointer;">
                </span>
            </div>

            <div class="col-sm-3">
                <label>სქესი</label>
                <select id="client_sex">
                    '.getSex($res['client_sex']).'
                </select>
            </div>

            <div class="col-sm-3">
                <label>ტელეფონი</label>
                <input value="'.$res['client_phone'].'" data-nec="0" style="height: 18px; width: 95%;" oninput="maxLengthCheck(this)" maxLength="9" type="number" id="client_phone" class="idle" autocomplete="off">
            </div>

            <div class="col-sm-3">
                <label>ჩაწერის თარიღი</label>
                <input value="'.$datetime.'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="order_date" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-3" style="display:none;">
            <label>დაწყება - დასრულება</label>
                <div class="row">
                    <div class="col-sm-6"><input style="width:99%;" type="text" id="start_proc" value="'.$res['start_proc'].'"></div>
                    <div class="col-sm-6"><input style="width:99%;" type="text" id="end_proc" value="'.$res['end_proc'].'"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <label>კომენტარი</label>
                <textarea style="width:100%" id="client_comment">'.$res['comment'].'</textarea>
            </div>

            

            <div class="col-sm-12">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
            <div class="col-sm-12">
                <label>პროცედურები</label>
                <div id="product_div"></div>
            </div>
            
            ';

            
            



        $data .= '</div></div>

    </fieldset>

    

    <input type="hidden" id="writing_id" value="'.$id.'">
    <input type="hidden" id="client_id" value="'.$res['client_id'].'">

    <input type="hidden" id="pr_personal" value="'.$personal_id.'">
    <input type="hidden" id="pr_hour" value="'.$hour.'">
    <input type="hidden" id="pr_minute" value="'.$minute.'">

    ';



    return $data;

}
function getReserve($id){
    GLOBAL $db;
    $db->setQuery(" SELECT 	procedures.id,
                            procedures.user_id,
                            TIME_FORMAT(procedures.duration, '%H:%i') AS duration,
                            TIME_FORMAT(procedures.start_proc, '%H:%i') AS start_proc,
                            orders.write_date,
                            orders.id AS order_id
                        
                            
                    FROM 	procedures
                    JOIN    orders ON orders.id = procedures.order_id AND orders.actived = 1
                    WHERE 	procedures.actived = 1 AND procedures.id = '$id'");

    $result = $db->getResultArray();
    return $result['result'][0];
}
function getWriting($id){

    GLOBAL $db;



    $db->setQuery(" SELECT 	orders.id,
                            orders.datetime,
                            orders.client_name,
                            orders.client_id,
                            orders.client_sex,
                            orders.client_phone,
                            orders.start_proc,
                            orders.end_proc,
                            orders.status_id,
                            orders.comment
                        
                            
                    FROM 	orders
                    WHERE 	orders.actived = 1 AND orders.id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];

}

function getPersonal($id){

    GLOBAL $db;

    $data = '';

    $db->setQuery("SELECT   id,

                            name AS 'name'

                    FROM    personal

                    WHERE   actived = 1");

    $cats = $db->getResultArray();

    foreach($cats['result'] AS $cat){

        if($cat[id] == $id){

            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';

        }

        else{

            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';

        }

        

    }



    return $data;

}
function getSex($id){
    GLOBAL $db;

    $data = '';

    $db->setQuery("SELECT   id,

                            name AS 'name'

                    FROM    sex

                    WHERE   actived = 1");

    $cats = $db->getResultArray();

    foreach($cats['result'] AS $cat){

        if($cat[id] == $id){

            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';

        }

        else{

            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';

        }

        

    }



    return $data;
}
function getStatuses($id){

    GLOBAL $db;

    $data = '';

    $db->setQuery("SELECT   id,

                            name AS 'name'

                    FROM    writing_status

                    WHERE   actived = 1");

    $cats = $db->getResultArray();

    foreach($cats['result'] AS $cat){

        if($cat[id] == $id){

            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';

        }

        else{

            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';

        }

        

    }



    return $data;

}

function getCab($id){

    GLOBAL $db;

    $data = '';

    $db->setQuery("SELECT   id,

                            name AS 'name'

                    FROM    cabinet");

    $cats = $db->getResultArray();

    foreach($cats['result'] AS $cat){

        if($cat[id] == $id){

            $data .= '<option value="'.$cat[id].'" selected="selected">'.$cat[name].'</option>';

        }

        else{

            $data .= '<option value="'.$cat[id].'">'.$cat[name].'</option>';

        }

        

    }



    return $data;

}
function sendSMS($template = '', $rowID = ''){
    GLOBAL $db;
    if($template == 'new_writing' && $rowID != ''){

        $db->setQuery(" SELECT  id,
                                temp_name AS title,
                                temp_text AS text

                        FROM    sms_templates
                        WHERE   id = '1'");

        $smsTemp = $db->getResultArray()['result'][0];

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
                        WHERE   procedures.actived = 1 AND procedures.order_id = '$rowID' AND procedures.send_sms_writing = 1 AND procedures.is_writing_sent = 0 AND procedures.status_id = 1 AND procedures.reservation = 0");

        $proceduresWriting = $db->getResultArray();

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

        }
    }
    else if($template == 'change' && $rowID != ''){
        $db->setQuery(" SELECT  id,
                                temp_name AS title,
                                temp_text AS text

                        FROM    sms_templates
                        WHERE   id = '2'");

        $smsTemp = $db->getResultArray()['result'][0];

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
                        WHERE   procedures.actived = 1 AND procedures.id = '$rowID' AND procedures.status_id = 1");

        $proceduresWriting = $db->getResultArray();

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

        }

    }
    else if($template == 'cancel' && $rowID != ''){
        $db->setQuery(" SELECT  id,
                                temp_name AS title,
                                temp_text AS text

                        FROM    sms_templates
                        WHERE   id = '4'");

        $smsTemp = $db->getResultArray()['result'][0];

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
                        WHERE   procedures.actived = 1 AND procedures.id = '$rowID' AND procedures.status_id = 3 AND procedures.reservation = 0");

        $proceduresWriting = $db->getResultArray();

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

        }
    }
}
?>