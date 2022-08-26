<?php
namespace Geopaysoft\TBCCheckout;

$payID = $_REQUEST['payID'];

require 'TBCCheckout.php';

$TBCCheckout = new TBCCheckout('7000836','an1Wxhy7h7vJl4Ia','zMW21YAIxRdPNxLOSGx8Adree0ODm4h2',true);


if (true && !empty($TBCCheckout->error))
echo $TBCCheckout->error;



   
$res = $TBCCheckout->GetPaymentInfo($payID);


if (isset($res['status']))
echo json_encode(array('status' => $res['status']));

?>