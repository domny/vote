<?php
include("../../services/vote_service.php");

$_loginUser = $context->getBrowser();
$smarty = new Smarty();
if (empty($_loginUser)) {
    echo'<a href="">please login</a>';
    $smarty->display("templates/view.tpl");
} else {

    if (!empty($_GET["fruit"])) {
        $values = explode("-", $_GET["fruit"]);
        $info = array();
        $info[seller_id] = 123456;
        $info[item_id] = $values[0];
        $info[nick] = $_loginUser->getNick();
        $info[cat_id] = 3;
        $info[memo] = 'vote';

        $id = addVoteInfo(json_encode($info));
        $smarty->assign("id", $id);
        $smarty->assign("loginUser", $_loginUser);
        $smarty->assign("voteItem", $values[1]);
    }


    $report = queryVoteResult(123456);
    $reportArray = json_decode($report, true);
    $smarty->assign("report", $reportArray);
    $smarty->display("templates/report.tpl");
}
$smarty->assign("myDomain",$_taeServer);
?>

