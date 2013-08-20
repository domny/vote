<?php
require_once("dbconfig.php");

/**
 * ͶƱ��Ŀ
 * @author shihong
 */
class VoteItem extends BaseDO
{
    /**
     * ͶƱ��Ŀ����
     * @var name
     */
    public $name;

    /**
     * ͶƱ��Ŀ�ķ���
     * @var cat_id
     */
    public $cat_id;

    /**
     * ͶƱ��Ŀ��id
     * @var id
     */
    public $id;

   /**
     * ͶƱ��Ŀ״̬�����������ᣩ
     * @var status
     */
    public $status;

      /**
     * ͶƱ��Ŀ��ע
     * @var status
     */
    public $memo;

     /**
     * ����id ����Ӧ�õ����� ϵͳ�ֶ�
     * @var sellerId
     */
    public $seller_id;

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
 * ͶƱ��Ŀ���ݷ��ʶ���
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
     * ����ͶƱ��Ŀid��ѯͶƱ��Ŀ
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
     * ��ѯ���ҵ�����ͶƱ��Ŀ
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
     * ����ͶƱ��Ŀ
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
     * ����ͶƱ��Ŀ
     * @param $voteItem
     * @return void
     */
    public function updateVoteItem($voteItem)
    {
        $sth = $this->pdo->prepare('update vote_item set name = ?, status = ?, memo = ? WHERE id = ?');
        $sth->execute(array($voteItem->name, $voteItem->status, $voteItem->memo, $voteItem->id));
    }

    /**
     * ɾ��ͶƱ��Ŀ
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
