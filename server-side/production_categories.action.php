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
    case 'get_sub_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPageSub());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage(getCategories($id)));
    break;
    case 'save_category':
        $id = $_REQUEST['id'];
        $title_geo = $_REQUEST['title_geo'];
        $title_rus = $_REQUEST['title_rus'];
        $title_eng = $_REQUEST['title_eng'];
        if($id == ''){
            $db->setQuery(" INSERT INTO  product_categories 
                            SET          title_geo = '$title_geo',
                                         title_rus = '$title_rus',
                                         title_eng = '$title_eng',
                                         user_id = '$user_id'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  product_categories 
                            SET     title_geo = '$title_geo',
                                    title_rus = '$title_rus',
                                    title_eng = '$title_eng',
                                    user_id = '$user_id'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'save_sub_category':
        $id = $_REQUEST['id'];
        $title_geo = $_REQUEST['title_geo'];
        $title_rus = $_REQUEST['title_rus'];
        $title_eng = $_REQUEST['title_eng'];
        $parent_id = $_REQUEST['parent_id'];
        if($id == ''){
            $db->setQuery(" INSERT INTO  product_categories 
                            SET          title_geo = '$title_geo',
                                         title_rus = '$title_rus',
                                         title_eng = '$title_eng',
                                         user_id = '$user_id',
                                         parent_id = '$parent_id'");
            $db->execQuery();
        }
        else{
            $db->setQuery(" UPDATE  product_categories 
                            SET     title_geo = '$title_geo',
                                    title_rus = '$title_rus',
                                    title_eng = '$title_eng',
                                    user_id = '$user_id'
                            WHERE   id = '$id'");
            $db->execQuery();
        }
    break;
    case 'disable':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE product_categories SET actived = 0 WHERE id = '$id'");
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

        $db->setQuery(" SELECT  id,
                                CONCAT('<img src=\"http://admin.iten.ge/',back_img,'\" style=\"height:150px;\">'),
                                title_geo,
                                title_rus,
                                title_eng,
                                CONCAT(position,' თანმიმდევრობა'),
                                CASE
                                    WHEN status_id = 1 THEN '<div class=\"cat_status_1\">აქტიური</div>'
                                    WHEN status_id = 2 THEN '<div class=\"cat_status_2\">მოდერაციაში</div>'
                                    WHEN status_id = 3 THEN '<div class=\"cat_status_3\">გამორთული</div>'
                                END AS `status`
                        FROM    product_categories
                        WHERE   actived = 1 AND user_id = '$user_id' AND parent_id = 0
                        ORDER BY id DESC");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
    case 'get_list_sub':
        $id          =      $_REQUEST['hidden'];
		
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];
        $parent_id   =      $_REQUEST['parent_id'];
        $db->setQuery(" SELECT  id,
                                
                                title_geo,
                                title_rus,
                                title_eng,
                                CONCAT(position,' თანმიმდევრობა'),
                                CASE
                                    WHEN status_id = 1 THEN '<div class=\"cat_status_1\">აქტიური</div>'
                                    WHEN status_id = 2 THEN '<div class=\"cat_status_2\">მოდერაციაში</div>'
                                    WHEN status_id = 3 THEN '<div class=\"cat_status_3\">გამორთული</div>'
                                END AS `status`
                        FROM    product_categories
                        WHERE   actived = 1 AND user_id = '$user_id' AND parent_id = '$parent_id'
                        ORDER BY id DESC");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
    break;
}


echo json_encode($data);
function getPageSub($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4">
                <label>კატეგორია GEO</label>
                <input value="'.$res[title_geo].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_geo_sub" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>კატეგორია RUS</label>
                <input value="'.$res[title_rus].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_rus_sub" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>კატეგორია ENG</label>
                <input value="'.$res[title_eng].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_eng_sub" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>

    <input type="hidden" id="sub_cat_id" value="'.$res[id].'">
    ';

    return $data;
}
function getPage($res = ''){
    $data .= '
    
    
    <fieldset class="fieldset">
        <legend>ინფორმაცია</legend>
        <div class="row">
            <div class="col-sm-4">
                <label>კატეგორია GEO</label>
                <input value="'.$res[title_geo].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_geo" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>კატეგორია RUS</label>
                <input value="'.$res[title_rus].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_rus" class="idle" autocomplete="off">
            </div>
            <div class="col-sm-4">
                <label>კატეგორია ENG</label>
                <input value="'.$res[title_eng].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="title_eng" class="idle" autocomplete="off">
            </div>
        </div>
    </fieldset>
    <fieldset class="fieldset">
        <legend>ქვე-კატეგორია</legend>
        <div id="sub_category_grid"></div>
    </fieldset>
    <fieldset class="fieldset">
        <legend>სურათი</legend>
        <div class="dialog_image">
            <img src="http://admin.iten.ge/'.$res[back_img].'">
        </div>
        <p id="upload_img" style="color:blue;text-decoration: underline;cursor: pointer; margin-left:40px;">სურათის შეცვლა</p>
        <input style="opacity: 0;" type="file" id="upload_back_img" name="image_upload" autocomplete="off">
    </fieldset>
    <input type="hidden" id="cat_id" value="'.$res[id].'">
    ';

    return $data;
}
function getCategories($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            back_img,
                            title_geo,
                            title_rus,
                            title_eng

                    FROM    product_categories
                    WHERE   id = '$id' AND actived = 1");
    $result = $db->getResultArray();

    return $result['result'][0];
}
?>