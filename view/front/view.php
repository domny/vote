
 <?
//include("../model/service/vote_service.php");
$phpService = $AppEngine->find('voteapp','vote_service');
$itemsjson= $phpService->queryVoteItems(123456);

//$itemsjson = queryVoteItems(123456);
$items = json_decode($itemsjson,true);

$smarty = new Smarty();
$smarty->assign("items", $items);
$smarty->assign("voteSubject",$_MODULE['vote_subject']);
$smarty->assign("myDomain",$_taeServer);

$smarty->display("templates/view.tpl");


 ?>
 




