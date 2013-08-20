<?
include("../../services/vote_service.php");


$action = $_GET["action"];
if(!empty($action)){
  if($action == 'delete'){
    $user_id=123456;
    $id = $_GET["id"];


    deleteVoteItem($user_id,$id);
  }
  else if($action == 'add'){
    $info = array();
    $info[seller_id]=123456;
    $info[cat_id]=3;
    $info[name]=$_POST["name"];
    $info[memo]=$_POST["memo"];


    $itemID = addVoteitem(json_encode($info));

  }
    
//forward
  include("itemlist.php");

 //redirect
  //header("location:itemlist.php");
}

