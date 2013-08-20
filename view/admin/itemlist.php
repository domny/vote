<?
include("../../services/vote_service.php");?>

<?
                $itemsjson = queryVoteItems(123456);
                $items = json_decode($itemsjson,true);


                $smarty = new Smarty();
                $smarty->assign("items", $items);
                $smarty->display("templates/itemlist.tpl");

?>



