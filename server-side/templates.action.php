<?php
error_reporting(E_ERROR);
include('../db.php');
GLOBAL $db;
$db = new dbClass();
$act = $_REQUEST['act'];
$user_id = $_SESSION['USERID'];

switch ($act){
    case 'get_system_temps':
        $db->setQuery(" SELECT id,temp_text
                        FROM sms_templates
                        WHERE actived = 1 AND id IN (1,2,3,4)
                        ORDER BY id ASC");


        $temps = $db->getResultArray();
        
        foreach($temps['result'] AS $temp){
            $data[$temp['id']] = $temp['temp_text'];
        }
        break;
    case 'save_sys_temp':
        $id = $_REQUEST['id'];
        $text = $_REQUEST['text'];


        $db->setQuery("UPDATE sms_templates SET temp_text='$text' WHERE id = '$id'");
        $db->execQuery();
        break;

    case 'get_list_temp':
        $columnCount = 		$_REQUEST['count'];
		$cols[]      =      $_REQUEST['cols'];

        $db->setQuery(" SELECT id,temp_name,temp_text
                        FROM sms_templates
                        WHERE actived = 1 AND default_temp = 0
                        ORDER BY id DESC");


        $result = $db->getKendoList($columnCount, $cols);

        $data = $result;
        break;
    case 'get_temp_page':
        $id = $_REQUEST['id'];
        if($id == '' OR !isset($_REQUEST['id'])){
            $db->setQuery("INSERT INTO sms_templates SET temp_name = NOW()");
            $db->execQuery();

            $id = $db->getLastId();

            $db->setQuery("DELETE FROM sms_templates WHERE id='$id'");
            $db->execQuery();
        }
        $data = array('page' => getTempPage($id,getTemp($id)));
        break;

    case 'save_temp':
        $id             = $_REQUEST['id'];
        $temp_title    = $_REQUEST['temp_title'];
        $temp_text   = $_REQUEST['temp_text'];

        $db->setQuery(" SELECT  COUNT(*) AS cc
                        FROM    sms_templates
                        WHERE   id = '$id' AND actived = 1");
        $isset = $db->getResultArray();

        if($isset['result'][0]['cc'] == 0){
            $db->setQuery("INSERT INTO sms_templates SET
                                                id = '$id',
                                                temp_name='$temp_title',
                                                temp_text='$temp_text'");

            $db->execQuery();
            $data['error'] = '';
        }

        else{
            $db->setQuery("UPDATE sms_templates SET     temp_name='$temp_title',
                                                        temp_text='$temp_text'
                            WHERE id='$id'");
            $db->execQuery();
            $data['error'] = '';
        }
    break;
    case 'disable':

        $ids = explode(',',$_REQUEST['id']);

        foreach($ids AS $id){
            $db->setQuery("UPDATE sms_templates SET actived = 0 WHERE id = '$id'");
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

                    }elseif($columns[$j] == "write_date" OR $columns[$j] == "impuls_qty" ){

                        $g = array('field'=>$columns[$j], 'hidden' => true,'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 100);

                    }
                    elseif($columns[$j] == "id2" OR $columns[$j] == "temp_name"){
                        $g = array('field'=>$columns[$j],'encoded'=>false,'title'=>$columnNames[0][$a],'filterable'=>array('multi'=>true,'search' => true), 'width' => 250);
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
}



echo json_encode($data);
function getTemp($id){
    GLOBAL $db;

    $db->setQuery(" SELECT  id,
                            temp_name AS title,
                            temp_text AS text

                    FROM    sms_templates
                    WHERE   id = '$id'");

    $result = $db->getResultArray();



    return $result['result'][0];
}
function getTempPage($id,$res = ''){
    GLOBAL $db;

    $data .= '

    <fieldset class="fieldset">
        <legend>შეტყობინება</legend>
        <div class="row">
            <div class="col-sm-6">
                <p>{clientFirstname} - <b>კლიენტის სახელი</b></p>
                <p>{clientLastname} - <b>კლიენტის გვარი</b></p>
                <p>{clientPhone} - <b>კლიენტის ტელეფონი</b></p>
            </div>
            <div class="col-sm-12">
                <label>შაბლონის სახელი</label>
                <input value="'.$res['title'].'" data-nec="0" style="height: 18px; width: 95%;" type="text" id="temp_title" class="idle" autocomplete="off"> 
            </div>

            <div class="col-sm-12">
                <label>ტექსტი</label>
                <textarea id="temp_text" class="template_textarea">'.$res['text'].'</textarea>
            </div>
            
        </div>
    </fieldset>
    <input type="hidden" id="temp_id" value="'.$id.'">
    ';



    return $data;
}