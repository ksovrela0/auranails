<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id    = $_SESSION['USERID'];
$obj_id     = $_SESSION['OBJID'];
$group_id   = $_SESSION['GRPID'];
switch ($act){
    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage($id));
    break;
    case 'get_courier_data_mobile':
        $db->setQuery(" SELECT      orders.id,
                                    orders.datetime,
                                    GROUP_CONCAT(CONCAT(products.title_geo,' X',orders_detail.portions)) AS 'order',
                                    CONCAT(orders.delivery_price,' GEL') AS 'price',
                                    orders.objToClient_km AS 'km_to_client',
                                    orders.client_address AS 'client_address',
                                    orders.client_data,
                                    CASE
                                            WHEN orders.status = 1 THEN '<div class=\"cat_status_1\">გადაუხდელი(ბარათით)</div>'
                                            WHEN orders.status = 2 THEN '<div class=\"cat_status_2\">ახალი შეკვეთა</div>'
                                            WHEN orders.status = 3 THEN '<div class=\"cat_status_3\">მზადების პროცესში</div>'
                                            WHEN orders.status = 4 THEN '<div class=\"cat_status_4\">მზადაა და ელოდება კურიერს/კლიენტს</div>'
                                            WHEN orders.status = 5 THEN '<div class=\"cat_status_5\">მიტანის პროცესში</div>'
                                            WHEN orders.status = 6 THEN '<div class=\"cat_status_6\">წარმატებულად დასრულებული</div>'
                                            WHEN orders.status = 7 THEN '<div class=\"cat_status_7\">წარუმატებელი</div>'
                                            WHEN orders.status = 8 THEN '<div class=\"cat_status_7\">გაუქმებული</div>'
                                    END AS 'status',
                                    CONCAT('<div order_id=\"',orders.id,'\" class=\"courier_start_order\">შეკვეთის აღება</div>') AS 'action'

                        FROM        orders
                        LEFT JOIN   orders_detail ON orders_detail.order_id = orders.id
                        LEFT JOIN	products ON products.id = orders_detail.product_id
                        WHERE 	    orders.actived = 1 AND orders.status >= 3 AND orders.status <= 5 AND (ISNULL(orders.courier_id) OR orders.courier_id = '' OR orders.courier_id = 0 OR orders.courier_id = '$_SESSION[USERID]')
                        GROUP BY    orders.id");
        $data = $db->getResultArray();
    break;
    case 'start_delivery':
        $order_id = $_REQUEST['order_id'];

        $db->setQuery(" SELECT  COUNT(*) AS 'cc' 
                        FROM    orders
                        WHERE   orders.id = '$order_id' AND orders.courier_id > 0 AND orders.status IN (4,5)");
        $cc = $db->getResultArray();

        if($cc['result'][0]['cc'] == 0){
            $db->setQuery(" UPDATE  orders
                            SET     courier_id = '$_SESSION[USERID]',
                                    status = 5
                            WHERE   id = '$order_id'");
            $db->execQuery();

            $db->setQuery(" UPDATE  users
                            SET     real_balance = real_balance+3
                            WHERE   id = '$_SESSION[USERID]'");
            $db->execQuery();
            $data['action'] = 'OK';
        }else{
            $data['action'] = 'error';
        }
        
    break;
    case 'not_delivering_poduct':
        $order_detail_id    = $_REQUEST['order_detail_id'];
        $order_id           = $_REQUEST['order_id'];
        $db->setQuery("UPDATE   orders_detail
                        SET     status = 2
                        WHERE   id = '$order_detail_id'");
        $db->execQuery();
    break;
    case 'not_delivering_order':
        $order_id           = $_REQUEST['order_id'];
        $db->setQuery(" UPDATE  orders
                        SET     status = 8
                        WHERE   id = '$order_id'");
        $db->execQuery();
    break;
    case 'ready_order':
        $order_id           = $_REQUEST['order_id'];
        $db->setQuery(" UPDATE  orders
                        SET     status = 4
                        WHERE   id = '$order_id'");
        $db->execQuery();
    break;
    case 'start_preparing':
        $order_id = $_REQUEST['order_id'];

        $db->setQuery(" SELECT  UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(datetime) AS 'passed_seconds',
                                status
                        FROM    orders
                        WHERE   id = '$order_id'");
        $getSeconds = $db->getResultArray();

        $passedSeconds = $getSeconds['result'][0]['passed_seconds'];
        if($getSeconds['result'][0]['status'] == 2){
            if($passedSeconds < 180){
                $data['action']         = 'not_passed_time';
                $data['passedSeconds']  = $passedSeconds;
            }
            else{
                $db->setQuery(" UPDATE  orders
                                SET     status = 3
                                WHERE   id = '$order_id'");
                $db->execQuery();
                $data['action'] = 'started';
            }
        }
        else{
            $data['action']         = '';
            $data['passedSeconds']  = '';
        }
        

    break;
    case 'delivering_poduct':
        $order_detail_id    = $_REQUEST['order_detail_id'];
        $order_id           = $_REQUEST['order_id'];
        $db->setQuery("UPDATE   orders_detail
                        SET     status = 1
                        WHERE   id = '$order_detail_id'");
        $db->execQuery();
    break;
    case 'save_product':
        $id = $_REQUEST['id'];
        $title_geo          = $_REQUEST['title_geo'];
        $title_rus          = $_REQUEST['title_rus'];
        $title_eng          = $_REQUEST['title_eng'];
        $poduct_category    = $_REQUEST['poduct_category'];
        $price              = $_REQUEST['price'];
        $price_sale         = $_REQUEST['price_sale'];
        $ingredients_geo    = $_REQUEST['ingredients_geo'];
        $ingredients_rus    = $_REQUEST['ingredients_rus'];
        $ingredients_eng    = $_REQUEST['ingredients_eng'];
        if($id == ''){
            $db->setQuery(" INSERT INTO  products 
                            SET          title_geo = '$title_geo',
                                         title_rus = '$title_rus',
                                         title_eng = '$title_eng',
                                         cat_id = '$poduct_category',
                                         price = '$price',
                                         price_sale = '$price_sale',
                                         ingredients_geo = '$ingredients_geo',
                                         ingredients_rus = '$ingredients_rus',
                                         ingredients_eng = '$ingredients_eng'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  products 
                            SET     title_geo = '$title_geo',
                                    title_rus = '$title_rus',
                                    title_eng = '$title_eng',
                                    cat_id = '$poduct_category',
                                    price = '$price',
                                    price_sale = '$price_sale',
                                    ingredients_geo = '$ingredients_geo',
                                    ingredients_rus = '$ingredients_rus',
                                    ingredients_eng = '$ingredients_eng'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE products SET actived = 0 WHERE id = '$id'");
            $db->execQuery();
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
					}elseif($columns[$j] == "id"){
						$g = array('field'=>$columns[$j], 'hidden' => false,'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 100);
					}elseif($columns[$j] == "inc_date"){
						$g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 130);
					}else{
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

        if($group_id == 3){
            $db->setQuery(" SELECT      orders.id,
                                        orders.datetime,
                                        GROUP_CONCAT(CONCAT(products.title_geo,' X',orders_detail.portions)) AS 'order',
                                        CONCAT(orders.delivery_price,' GEL') AS 'price',
                                        orders.objToClient_km AS 'km_to_client',
                                        orders.client_address AS 'client_address',
                                        orders.client_data,
                                        CASE
                                                WHEN orders.status = 1 THEN '<div class=\"cat_status_1\">გადაუხდელი(ბარათით)</div>'
                                                WHEN orders.status = 2 THEN '<div class=\"cat_status_2\">ახალი შეკვეთა</div>'
                                                WHEN orders.status = 3 THEN '<div class=\"cat_status_3\">მზადების პროცესში</div>'
                                                WHEN orders.status = 4 THEN '<div class=\"cat_status_4\">მზადაა და ელოდება კურიერს/კლიენტს</div>'
                                                WHEN orders.status = 5 THEN '<div class=\"cat_status_5\">მიტანის პროცესში</div>'
                                                WHEN orders.status = 6 THEN '<div class=\"cat_status_6\">წარმატებულად დასრულებული</div>'
                                                WHEN orders.status = 7 THEN '<div class=\"cat_status_7\">წარუმატებელი</div>'
                                                WHEN orders.status = 8 THEN '<div class=\"cat_status_7\">გაუქმებული</div>'
                                        END AS 'status',
                                        CONCAT('<div order_id=\"',orders.id,'\" class=\"courier_start_order\">შეკვეთის აღება</div>') AS 'action'

                            FROM        orders
                            LEFT JOIN   orders_detail ON orders_detail.order_id = orders.id
                            LEFT JOIN	products ON products.id = orders_detail.product_id
                            WHERE 	    orders.actived = 1 AND orders.status >= 3 AND orders.status <= 5 AND (ISNULL(orders.courier_id) OR orders.courier_id = '' OR orders.courier_id = 0 OR orders.courier_id = '$_SESSION[USERID]')
                            GROUP BY    orders.id");
        }
        else{
            $db->setQuery(" SELECT       orders.id,
                                        orders.datetime,
                                        GROUP_CONCAT(CONCAT(products.title_geo,' X',orders_detail.portions)) AS 'order',
                                        CONCAT(orders.amount,' GEL') AS 'price',
                                        details,
                                        CASE
                                                WHEN orders.status = 1 THEN '<div class=\"cat_status_1\">გადაუხდელი(ბარათით)</div>'
                                                WHEN orders.status = 2 THEN '<div class=\"cat_status_2\">ახალი შეკვეთა</div>'
                                                WHEN orders.status = 3 THEN '<div class=\"cat_status_3\">მზადების პროცესში</div>'
                                                WHEN orders.status = 4 THEN '<div class=\"cat_status_4\">მზადაა და ელოდება კურიერს/კლიენტს</div>'
                                                WHEN orders.status = 5 THEN '<div class=\"cat_status_5\">მიტანის პროცესში</div>'
                                                WHEN orders.status = 6 THEN '<div class=\"cat_status_6\">წარმატებულად დასრულებული</div>'
                                                WHEN orders.status = 7 THEN '<div class=\"cat_status_7\">წარუმატებელი</div>'
                                                WHEN orders.status = 8 THEN '<div class=\"cat_status_7\">გაუქმებული</div>'
                                        END AS 'status'

                            FROM        orders
                            LEFT JOIN   orders_detail ON orders_detail.order_id = orders.id
                            LEFT JOIN	products ON products.id = orders_detail.product_id
                            WHERE 	    orders.actived = 1 AND orders.object_id = '$obj_id'
                            GROUP BY    orders.id");
        }
        

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    case 'get_list_detail':
        $id          =      $_REQUEST['order_id'];
		
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $db->setQuery(" SELECT      orders_detail.id,
                                    CONCAT('<img src=\"http://admin.iten.ge/',products.back_img,'\" style=\"height:70px;\">'),
                                    products.title_geo,
                                    CONCAT(orders_detail.portions,' ცალი X ',IF(products.price_sale = 0.00,products.price,products.price_sale), ' = ', orders_detail.portions*IF(products.price_sale = 0.00,products.price,products.price_sale)) AS price,
                                    orders_detail.comment,
                                    CASE
                                        WHEN orders_detail.status = 2 THEN '<span class=\"badge badge-danger\">ვერ ვაწვდით</span>'
                                        WHEN orders_detail.status = 1 THEN '<span class=\"badge badge-success\">ვაწვდით</span>'
                                        WHEN orders_detail.status = 3 THEN '<span class=\"badge badge-secondary\">ჩამატებული</span>'
                                    END AS 'status',
                                    IF(orders_detail.status = 1,CONCAT('<div id=\"not_have\" order_id=\"',orders_detail.id,'\" style=\"background-color:#ffee1d;font-weight: bold;border-radius:10px;margin: 4px;padding:7px;cursor:pointer;\"><img src=\"assets/img/icons/forbidden.png\" style=\"height:24px;\"> ვერ ვაწვდით</div>'),CONCAT('<div id=\"have_deliver\" order_id=\"',orders_detail.id,'\" style=\"background-color:#ffee1d;font-weight: bold;border-radius:10px;margin: 4px;padding:7px;cursor:pointer;\">ვაწვდით</div>')) AS 'action'
                        FROM        orders_detail
                        JOIN		orders ON orders.id = orders_detail.order_id
                        LEFT JOIN	products ON products.id = orders_detail.product_id
                        WHERE       orders_detail.order_id = '$id' AND orders_detail.actived = 1 AND orders.object_id = '$obj_id'
                        GROUP BY    orders_detail.id");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    //<div id=\"change_product\" style=\"background-color:#ffee1d;font-weight: bold;margin: 4px;border-radius:10px;padding:7px;cursor:pointer;\">ჩანაცვლება</div> IF NEEDED
}


echo json_encode($data);

function getPage($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div id="orders_detail"></div>
        </div>
    </fieldset>
    <input type="hidden" value="'.$res.'" id="order_id">
    ';

    return $data;
}
function get_cat_1($id){
    GLOBAL $db;
    $data = '';
    $db->setQuery("SELECT   id,
                            title_geo AS 'name'
                    FROM    product_categories
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
function getProduct($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  products.id,
                            products.back_img,
                            products.title_geo,
                            products.title_rus,
                            products.title_eng,
                            product_categories.id AS 'category',
                            products.price_sale,
                            products.ingredients_geo,
                            products.ingredients_rus,
                            products.ingredients_eng,
                            products.price
                    FROM    products
                    LEFT JOIN product_categories ON product_categories.id = products.cat_id
                    WHERE   products.id = '$id' AND products.actived = 1");
    $result = $db->getResultArray();

    return $result['result'][0];
}
?>