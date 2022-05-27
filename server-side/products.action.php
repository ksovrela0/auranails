<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];

switch ($act){
    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage(getProduct($id)));
    break;
    case 'add_ingridient':
        $id = $_REQUEST['product_id'];
        $data = array('page' => getIngrPage(getIngr($id)));
    break;
        break;
    case 'get_additional_ingredients':
        $id             = $_REQUEST['product_id'];
        $columnCount    = $_REQUEST['count'];
		$cols[]         = $_REQUEST['cols'];
        $db->setQuery(" SELECT  id,
                                name_geo,
                                name_rus,
                                name_eng,
                                price
                        FROM    additional_product_ingredients
                        WHERE   actived = 1 AND product_id = '$id'");
       $data = $db->getKendoList($columnCount, $cols);


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
                                         ingredients_eng = '$ingredients_eng',
                                         user_id = '$user_id'");
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
                                    ingredients_eng = '$ingredients_eng',
                                    user_id = '$user_id'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'save_ingridient':
        $id         = $_REQUEST['ingr_id'];
        $product_id = $_REQUEST['product_id'];
        $title_geo  = $_REQUEST['title_geo'];
        $title_rus  = $_REQUEST['title_rus'];
        $title_eng  = $_REQUEST['title_eng'];
        $price      = $_REQUEST['price'];
        if($id == ''){
            $db->setQuery(" INSERT INTO  additional_product_ingredients 
                            SET          name_geo = '$title_geo',
                                         name_rus = '$title_rus',
                                         name_eng = '$title_eng',
                                         product_id = '$product_id',
                                         price = '$price'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  additional_product_ingredients 
                            SET     name_geo = '$title_geo',
                                    name_rus = '$title_rus',
                                    name_eng = '$title_eng',
                                    product_id = '$product_id',
                                    price = '$price'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable_ingr':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE additional_product_ingredients SET actived = 0 WHERE id = '$id'");
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

        $db->setQuery(" SELECT  products.id,
                                CONCAT('<img src=\"http://admin.iten.ge/',products.back_img,'\" style=\"height:150px;\">'),
                                products.title_geo,
                                products.title_rus,
                                products.title_eng,
                                product_categories.title_geo,
                                IF(ISNULL(products.price_sale) OR products.price_sale = 0,CONCAT(products.price,' GEL'),CONCAT(products.price_sale,' GEL <p style=\"text-decoration: line-through;\">',products.price,' GEL</p>')),
                                CASE
                                    WHEN products.status_id = 1 THEN '<div class=\"cat_status_1\">აქტიური</div>'
                                    WHEN products.status_id = 2 THEN '<div class=\"cat_status_2\">მოდერაციაში</div>'
                                    WHEN products.status_id = 3 THEN '<div class=\"cat_status_3\">გამორთული</div>'
                                END AS `status`
                        FROM    products
                        LEFT JOIN product_categories ON product_categories.id = products.cat_id
                        WHERE   products.actived = 1 AND products.user_id = '$user_id'
                        ORDER BY products.id DESC");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
}


echo json_encode($data);
function getIngr($id){
    GLOBAL $db;
    $db->setQuery(" SELECT  id,
                            name_geo,
                            name_rus,
                            name_eng,
                            price
                    FROM    additional_product_ingredients
                    WHERE   actived = 1 AND id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];  
}
function getIngrPage($res){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-12">
                <label>დასახელება GEO</label>
                <input value="'.$res[name_geo].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_geo_ingr" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-12">
                <label>დასახელება RUS</label>
                <input value="'.$res[name_rus].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_rus_ingr" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-12">
                <label>დასახელება ENG</label>
                <input value="'.$res[name_eng].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_eng_ingr" class="idle" autocomplete="off">
            </div>

            <div class="col-sm-12">
                <label>ფასი</label>
                <input value="'.$res[price].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="price_ingr" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    <input type="hidden" id="ingr_id" value="'.$res[id].'">';

    return $data;
}
function getPage($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4">
                <label>დასახელება GEO</label>
                <input value="'.$res[title_geo].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_geo" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>დასახელება RUS</label>
                <input value="'.$res[title_rus].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_rus" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>დასახელება ENG</label>
                <input value="'.$res[title_eng].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_eng" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>კატეგორია</label>
                <select id="poduct_category">'.get_cat_1($res[category]).'</select>
            </div>
            <div class="col-sm-4">
                <label>ფასი</label>
                <input value="'.$res[price].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="price" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>ფასი ფასდაკლებით</label>
                <input value="'.$res[price_sale].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="price_sale" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend>აღწერა</legend>
        <div class="col-sm-12">
            <label>ინგრედიენტები GEO</label>
            <textarea style="width: 100%;" id="ingredients_geo">'.$res[ingredients_geo].'</textarea>
        </div>
        <div class="col-sm-12">
            <label>ინგრედიენტები RUS</label>
            <textarea style="width: 100%;" id="ingredients_rus">'.$res[ingredients_rus].'</textarea>
        </div>
        <div class="col-sm-12">
            <label>ინგრედიენტები ENG</label>
            <textarea style="width: 100%;" id="ingredients_eng">'.$res[ingredients_eng].'</textarea>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend>დამატებითი ინგრედიენტები</legend>
        <div class="col-sm-12">
            <div id="add_ingr"></div>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend>სურათი</legend>
        <div class="dialog_image">
            <img src="http://admin.iten.ge/'.$res[back_img].'">
        </div>
        <p id="upload_img" style="color:blue;text-decoration: underline;cursor: pointer; margin-left:40px;">სურათის შეცვლა</p>
        <input style="opacity: 0;" type="file" id="upload_back_img" name="image_upload" autocomplete="off">
    </fieldset>
    <input type="hidden" id="product_id" value="'.$res[id].'">
    ';

    return $data;
}
function get_cat_1($id){
    GLOBAL $db;
    $data = '';
    $user_id = $_SESSION['USERID'];
    $db->setQuery("SELECT   id,
                            title_geo AS 'name'
                    FROM    product_categories
                    WHERE   actived = 1 AND product_categories.user_id = '$user_id'");
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