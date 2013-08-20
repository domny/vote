<?php
require_once("dbconfig.php");

/**
 * 投票条目
 * @author shihong
 */
class VoteItem extends BaseDO
{
    /**
     * 投票条目名称
     * @var name
     */
    public $name;

    /**
     * 投票条目的分类
     * @var cat_id
     */
    public $cat_id;

    /**
     * 投票条目的id
     * @var id
     */
    public $id;

   /**
     * 投票条目状态（正常、冻结）
     * @var status
     */
    public $status;

      /**
     * 投票条目备注
     * @var status
     */
    public $memo;

     /**
     * 卖家id 购买应用的卖家 系统字段
     * @var sellerId
     */
    public $seller_id;

    /**
     * 记录创建时间，系统字段，后面未必开放给用户
     * @var DateTime
     */
    public $gmt_create;

    /**
     * 记录修改时间，系统字段，后面未必开放给用户
     * @var DateTime
     */
    public $gmt_modified;

}

/**
 * 投票条目数据访问对象
 * @author shihong
 */
class VoteItemDAO
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        global $votePDO;
        $this->pdo =  $votePDO;
    }

    /**
     * 根据投票条目id查询投票条目
     * @param $id
     * @return VoteItem
     */
    public function findVoteItemById($id)
    {
        $sql = "SELECT * FROM vote_item WHERE id=" . $id;
        $row = $this->pdo->query($sql)->fetch();
        return new VoteItem($row);
    }

    /**
     * 查询卖家的所有投票条目
     * @param $userId number user id
     * @return VoteItem[]
     */
    public function findVoteItemsBySellerId($userId)
    {
        $items = array();
        $sql = "SELECT * FROM vote_item WHERE seller_id = " . $userId . " and status =0";
        foreach ($this->pdo->query($sql) as $row) {
            $items[] = new VoteItem($row);
        }
        return $items;
    }




    /**
     * 创建投票条目
     * @param $voteItem
     * @return number
     */
    public function createVoteItem($voteItem)
    {
        $sth = $this->pdo->prepare('insert into vote_item(seller_id, name,status,memo,cat_id, gmt_create, gmt_modified)
                           values(?,?,?,?,?,?,?)');
        $sth->execute(array($voteItem->seller_id, $voteItem->name, 0,
                           $voteItem->memo, $voteItem->cat_id,date("Y-m-d H:i:s"),date("Y-m-d H:i:s")));
        return $this->pdo->lastInsertId();
    }

    /**
     * 更新投票条目
     * @param $voteItem
     * @return void
     */
    public function updateVoteItem($voteItem)
    {
        $sth = $this->pdo->prepare('update vote_item set name = ?, status = ?, memo = ? WHERE id = ?');
        $sth->execute(array($voteItem->name, $voteItem->status, $voteItem->memo, $voteItem->id));
    }

    /**
     * 删除投票条目
     * @param $id number id
     * @return void
     */
    public function deleteVoteItem($user_id, $id)
    {
        $this->pdo->exec("delete from vote_item where id = " . $id.' and seller_id ='. $user_id);
    }
}

/**
 * @global
 */
$voteItemDAO = new VoteItemDAO();
