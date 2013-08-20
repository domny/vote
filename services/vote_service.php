<?php
include("../dao/vote_cat_dao.php");
include("../dao/vote_item_dao.php");
include("../dao/vote_info_dao.php");

/**
 * 发起投票
 * @param  $jsonInfo 投票信息
 * @return number
 */
function addVoteInfo($jsonInfo)
{
    global $voteInfoDAO;
    $item = json_decode($jsonInfo,true);
    $voteInfo = new VoteInfo($item);

    return $voteInfoDAO->createVoteInfo($voteInfo);
}

function findVoteInfosBySellerId($userId){
	$appLog->debug("findVoteInfosBySellerId");
    global $voteInfoDAO;
    $items = $voteInfoDAO->findVoteInfosBySellerId($userId);
    return json_encode($items);
}

/**
 * 查询投票结果报告
 * @para $userId 卖家
 * @return string json数字
 */
function queryVoteResult($userId)
{
    global $voteInfoDAO;
    $items = $voteInfoDAO->findVoteResultBySellerId($userId);
    return json_encode($items);
}

/**
 * 添加投票条目
 * @param  $jsonInfo 投票条目
 * @return number
 */
function addVoteitem($jsonInfo)
{
    global $voteItemDAO;
    $item = json_decode($jsonInfo,true);
    $voteItem = new VoteItem($item);
    return $voteItemDAO->createVoteItem($voteItem);
}

/**
 * 获取所有投票条目
 * @param  $userId 卖家
 * @return string
 */
function queryVoteItems($userId)
{

	$appLog->debug("queryVoteItems");
	
    global $voteItemDAO;
    $items = array();
    $items = $voteItemDAO->findVoteItemsBySellerId($userId);
    return json_encode($items);
}

/**
 * 删除投票条目
 * @param  $userId 卖家
 * @return string
 */
function deleteVoteItem($userId, $id)
{
    global $voteItemDAO;
    $voteItemDAO->deleteVoteItem($userId, $id);
}

?>
