<?php
require_once("dbconfig.php");

class VoteResult  extends BaseDO{
    /**
     * @var
     */
    public $item_id;

     /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $count;

}
/**
 * ͶƱ��¼
 *
 * @author shihong
 */
class VoteInfo extends BaseDO
{
    /**
     * ͶƱ���û�id��Ҫ�����Ƿ�Կ����߿ɼ�
     * @var nick
     */
    public $nick;

    /**
     * ͶƱ��Ŀ
     * @var item_id
     */
    public $item_id;

      /**
     * ͶƱ��Ŀ����
     * @var item_id
     */
    public $name;

    /**
     * ͶƱ��Ŀ����
     * @var $cat_id
     */
    public $cat_id;
    /**
     * ����id
     * @var sellerId
     */
    public $seller_id;

     /**
     * ״̬
     * @var status
     */
    public $status;

    /**
     * @var  $memo
     */
     public $memo;

    /**
     * ��¼����ʱ�䣬ϵͳ�ֶΣ�����δ�ؿ��Ÿ��û�
     * @var DateTime
     */
    public $gmt_create;

    /**
     * ��¼�޸�ʱ�䣬ϵͳ�ֶΣ�����δ�ؿ��Ÿ��û�
     * @var DateTime
     */
    public $gmt_modified;
}

/**
 * onsale item DAO
 * @author leijuan
 */
class VoteInfoDAO
{
    /**
     * pdo
     * @var PDOTemplate
     */
    protected $pdo;

    /**
     * ���캯��
     * @param $pdo PDOTemplate pdo template
     */
    public function __construct()
    {
        global $votePDO;
        $this->pdo =  $votePDO;
    }

    /**
     * find onsale item by id
     * @param $id string item id
     * @return VoteInfo
     */
    public function findVoteInfoById($id)
    {
        $sql = "SELECT * FROM vote_info WHERE id=" . $id . " and status=0";
        $row = $this->pdo->query($sql)->fetch();
        return new VoteInfo($row);
    }

       /**
     * ��ѯĳ���û���ͶƱ��¼
     * @param $nick
     * @return VoteInfo[]
     */
    public function findVoteInfosByUserId($nick)
    {
        $items = array();
        $sql = "SELECT * FROM vote_info WHERE nick=" .$nick . " and status=0";
        foreach ($this->pdo->query($sql) as $row) {
            $items[] =  new VoteInfo($row);
        }
        return $items;
    }

    /**
     * ��ѯĳ����������20��ͶƱ��¼
     * @param $userId number user id
     * @return VoteInfo[]
     */
    public function findVoteInfosBySellerId($userId)
    {
        $items = array();
        $sql = "SELECT a.*,b.name FROM vote_info a left join vote_item b on a.item_id=b.id where a.seller_id = " . $userId . "
and a.status=0 order by a.id desc limit 20";

        foreach ($this->pdo->query($sql) as $row) {
            $items[] =  new VoteInfo($row);
        }
        return $items;
    }

    /**
     * ��ѯĳ������ͶƱ���
     * @param $userId number user id
     * @return VoteInfo[]
     */
    public function findVoteResultBySellerId($userId)
    {
        $items = array();
        $sql = "select item_id,b.name,count(*) count from vote_info  a left join vote_item b on a.item_id=b.id where a.seller_id = ".$userId." and a.status=0 group by a.item_id";
        foreach ($this->pdo->query($sql) as $row) {
            $items[] =  new VoteResult($row);
        }
        return $items;
    }

    /**
     * ����ͶƱ��¼
     * @param $voteInfo
     * @return number
     */
    public function createVoteInfo($voteInfo)
    {
        $sth = $this->pdo->prepare('insert into vote_info(nick,item_id,status,seller_id,cat_id,memo,gmt_create,gmt_modified)
                           values(?,?,?,?,?,?,?,?)');

        $sth->execute(array($voteInfo->nick, $voteInfo->item_id, 0, $voteInfo->seller_id,
                           $voteInfo->cat_id, $voteInfo->memo,date("Y-m-d H:i:s"),date("Y-m-d H:i:s")));
        return $this->pdo->lastInsertId();
    }
    

       public function createVoteInfo1($voteInfo)
    {
        $sql ="insert into vote_info(nick,item_id,status,seller_id,cat_id,memo,gmt_create,gmt_modified)
                           values('".$voteInfo->nick."', ".$voteInfo->item_id.",0, ".$voteInfo->seller_id.",
                           ".$voteInfo->cat_id.", '".$voteInfo->memo."',now(),now())";
        $sth = $this->pdo->exec($sql);

        return $this->pdo->lastInsertId();
    }


    /**
     * ɾ��ͶƱ��¼
     * @param $id
     * @return void
     */
    public function deleteVoteInfo($id)
    {
        $this->pdo->exec("delete from vote_info where id = " . $id);
    }
}

/**
 * @global
 */
$voteInfoDAO = new VoteInfoDAO();