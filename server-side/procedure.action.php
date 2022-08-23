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
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $db->setQuery(" SELECT  `procedure`.id,
                                `procedure`.name,
                                `procedure`.price,
                                `procedure`.duration,
                                GROUP_CONCAT(CONCAT(personal.name, ' ', personal.lastname) SEPARATOR ', ') AS 'grafik',
                                CONCAT('<div style=\"width:50px; height:10px; background-color:',procedure.color,';\"></div>')
                        FROM    `procedure`
                        LEFT JOIN    `procedure_personal` ON procedure_personal.procedure_id = `procedure`.id
                        LEFT JOIN		 personal ON personal.id = procedure_personal.personal_id
                        WHERE   `procedure`.actived = 1
                        GROUP BY `procedure`.id");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
        break;

    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $db->setQuery(" SELECT  GROUP_CONCAT(personal_id) AS week_day_id
                        FROM    procedure_personal
                        WHERE   procedure_id = '$id'");
        $grafik = $db->getResultArray()['result'][0];
        $data = array('page' => getPage(getPers($id)), "selectedZones" => $grafik['week_day_id']);


    break;
    case 'get_personal':
        $db->setQuery("	SELECT 	`id`,
								CONCAT(`name`, ' ', lastname) AS name
						FROM   	`personal`
						WHERE  	`actived` = 1");

		$data = $db->getResultArray();
        break;
    case 'save_personal':
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $price = $_REQUEST['price'];
        $duration = $_REQUEST['duration'];
        $color = $_REQUEST['color'];

        $personals = $_REQUEST['personal'];

        if($id == ''){
            $db->setQuery("INSERT INTO  `procedure` SET name = '$name',
                                                price = '$price',
                                                duration = '$duration',
                                                color='$color'");
            $db->execQuery();

            $id = $db->getLastId();
        }
        else{
            $db->setQuery("UPDATE `procedure` SET name = '$name',
                                                price = '$price',
                                                duration = '$duration',
                                                color='$color'
                                                WHERE id = '$id'");
            $db->execQuery();
        }

        $db->setQuery("DELETE FROM procedure_personal WHERE procedure_id = '$id'");
        $db->execQuery();
        foreach($personals AS $personal){
            $db->setQuery("INSERT INTO procedure_personal SET personal_id = '$personal', procedure_id='$id'");
            $db->execQuery();
        }
        break;
    case 'disable':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE `procedure` SET actived = 0 WHERE id = '$id'");
            $db->execQuery();

        }
        break;
}

echo json_encode($data);

function getPers($id){
    GLOBAL $db;

    $db->setQuery(" SELECT      id,
                                name,
                                price,
                                duration,
                                color

                    FROM        `procedure`
                    WHERE       id = '$id'");
    $result = $db->getResultArray();

    return $result['result'][0];
}

function getPage($res = ''){
    GLOBAL $db;

    $data = '<fieldset class="fieldset">
                <legend>ინფორმაცია</legend>
                <div class="row">
                    <div class="col-sm-4">
                        <label>სახელი</label>
                        <input value="'.$res[name].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="proc_name" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>ფასი</label>
                        <input value="'.$res[price].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="price" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>ხანგძლივობა</label>
                        <input value="'.$res[duration].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="duration" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>ფერი</label>
                        <input value="'.$res[color].'" data-nec="0" style="height: 18px; width: 95%;" type="color" id="color" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-12">
                        <label>პერსონალი</label>
                        <select id="personal" style="width: 100% !important; font-size: 12px;"></select>
                    </div>
                    
                </div>
                <input type="hidden" id="procedure_id" value="'.$res[id].'"
            </fieldset>';

    return $data;
}
?>