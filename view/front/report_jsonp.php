<?php
include("../../services/vote_service.php");
include("../../services/shop_info_service.php");
 $callback = $_GET["callback"];
 $type = $_GET["type"];

  $report = queryVoteResult(123456);
  $reportArray = json_decode($report, true);

echo $callback.'({"items":[';
    $count =1;

if($type == "top"){
     $nick = $_GET["nick"];
       $resp = getShopInfo($nick);
       if(isset($resp->code)){
                 if(isset($resp->code)){
                       echo '{"name":"' . $resp->code . '","nick":"' .$resp->msg. '"}';
                 }
        }
    else{
            $name=utf8_decode($resp->shop[0]->title);
            echo '{"name":"' . $name . '","nick":"' .$resp->shop[0]->nick . '"}';
    }

}elseif($type == "fetchurl"){

}
elseif($type == "cron"){

}
else{
     echo '{"name":"' . '1' . '-' . 'li' . '","count":"' .'3' . '"}';
}
//    foreach ($reportArray as $reportItem) {
//        if($count>1){
//         echo ',';
//        }
//       echo '{"name":"' . $reportItem[item_id] . '-' . $reportItem[name] . '","count":"' . $reportItem[count] . '"}';
//        $count = $count+1;
//    }
 echo ']})';
?>

