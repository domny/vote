<?
include("../top/topclient.php");
include("../top/ShopGetRequest.php");

/**
 * 获取店铺首页信息
 * @param  $nick
 * @return mixed|SimpleXMLElement
 */
function getShopInfo($nick)
{
    $c = new TopClient();
    $c->appkey = "21089912";
    $c->secretKey = "730d93025cbdd352c4e1a8e64f13bcc4";
    $req = new ShopGetRequest();
    $req->setFields("sid,cid,title,nick,desc,bulletin,pic_path,created,modified");
//$req->setNick(utf8_encode(""));
    $req->setNick($nick);

    $resp = $c->execute($req);

    return  $resp;

}



?>