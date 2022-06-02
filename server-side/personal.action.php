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

        $db->setQuery(" SELECT  personal.id,
                                CONCAT(personal.name, ' ', personal.lastname),
                                personal.phone,
                                CONCAT(personal.work_start, '-', personal.work_end, ' ', GROUP_CONCAT(week.name SEPARATOR ', ')) AS 'grafik',
                                CONCAT(personal.salary,'%')
                        FROM    personal
                        LEFT JOIN    personal_work_days ON personal_work_days.personal_id = personal.id
                        LEFT JOIN		 week ON week.id = personal_work_days.week_day_id
                        WHERE   personal.actived = 1
                        GROUP BY personal.id");

        $result = $db->getKendoList($columnCount, $cols);
        $data = $result;
        break;

    case 'get_add_page':
        $id = $_REQUEST['id'];
        $data = array('page' => getPage());
    break;
    case 'get_edit_page':
        $id = $_REQUEST['id'];
        $db->setQuery(" SELECT  GROUP_CONCAT(week_day_id) AS week_day_id
                        FROM    personal_work_days
                        WHERE   personal_id = '$id'");
        $grafik = $db->getResultArray()['result'][0];
        $data = array('page' => getPage(getPers($id)), "selectedZones" => $grafik['week_day_id']);


    break;
    case 'get_week_day':
        $db->setQuery("	SELECT 	`id`,
								`name`
						FROM   	`week`
						WHERE  	`actived` = 1");

		$data = $db->getResultArray();
        break;
    case 'save_personal':
        $id = $_REQUEST['id'];
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $phone = $_REQUEST['phone'];
        $salary = $_REQUEST['salary'];
        $work_start = $_REQUEST['work_start'];
        $work_end = $_REQUEST['work_end'];
        $days = $_REQUEST['grafik'];

        if($id == ''){
            $db->setQuery("INSERT INTO  personal SET name = '$firstname',
                                                lastname = '$lastname',
                                                phone = '$phone',
                                                salary = '$salary',
                                                work_start = '$work_start',
                                                work_end = '$work_end'");
            $db->execQuery();

            $id = $db->getLastId();
        }
        else{
            $db->setQuery("UPDATE personal SET name = '$firstname',
                                                lastname = '$lastname',
                                                phone = '$phone',
                                                salary = '$salary',
                                                work_start = '$work_start',
                                                work_end = '$work_end'
                                                WHERE id = '$id'");
            $db->execQuery();
        }

        $db->setQuery("DELETE FROM personal_work_days WHERE personal_id = '$id'");
        $db->execQuery();
        foreach($days AS $day){
            $db->setQuery("INSERT INTO personal_work_days SET personal_id = '$id', week_day_id='$day'");
            $db->execQuery();
        }
        break;
    case 'disable':
        $ids = $_REQUEST['id'];
        $ids = explode(',',$ids);

        foreach($ids AS $id){
            $db->setQuery("UPDATE personal SET actived = 0 WHERE id = '$id'");
            $db->execQuery();

        }
        break;
}

echo json_encode($data);

function getPers($id){
    GLOBAL $db;

    $db->setQuery(" SELECT      id,
                                name,
                                lastname,
                                phone,
                                salary,
                                work_start,
                                work_end

                    FROM        personal
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
                        <input value="'.$res[name].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="firstname" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>გვარი</label>
                        <input value="'.$res[lastname].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="lastname" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>ტელეფონი</label>
                        <input value="'.$res[phone].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="phone" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <label>ხელფასი %</label>
                        <input value="'.$res[salary].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="salary" class="idle" autocomplete="off">
                    </div>
                    <div class="col-sm-8">
                        <label>გრაფიკი</label>
                        <select id="grafik" style="width: 100% !important; font-size: 12px;"></select>
                    </div>
                    <div class="col-sm-4">
                        <label>დაწყება - დასრულება</label>
                        <div class="row">
                            <div class="col-sm-6"><input style="width:99%;" type="text" id="work_start" value="'.$res['work_start'].'"></div>
                            <div class="col-sm-6"><input style="width:99%;" type="text" id="work_end" value="'.$res['work_end'].'"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="personal_id" value="'.$res[id].'"
            </fieldset>';

    return $data;
}
?>