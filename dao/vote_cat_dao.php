<?php
require_once("dbconfig.php");




/**
 * 投票条目的分类
 * @author shihong
 */
class VoteCat extends BaseDO
{
    /**
     * 投票条目分类名称
     * @var name
     */
    public $name;

    /**
     * 投票条目分类id
     * @var id
     */
    public $id;

   /**
     *状态（正常0、冻结-1）
     * @var status
     */
    public $status;

    /**
     * 备注信息
     * @var memo
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
 * 投票条目分类数据访问层
 * @author shihong
 */
class VoteCatDAO
{
    /**
     *
     * @var $pdo
    */
    protected $pdo;

    public function __construct()
    {
        global $votePDO;
        $this->pdo =  $votePDO;
    }

  /**
   * 根据id查询投票分类
   * @param  $id
   * @return VoteCat
   */
    public function findVoteCatById($id)
    {
        $sql = "SELECT * FROM vote_cat WHERE id=" . $id;
        $row = $this->pdo->query($sql)->fetch();
        return new VoteCat($row);
    }

    /**
     * 根据卖家查询投票分类
     * @param  $userId
     * @return array
     */
    public function findVoteCatBySellerId($userId)
    {
        $cats = array();
        $sql = "SELECT * FROM vote_cat WHERE seller_id = " . $userId ." and status =0";
        foreach ($this->pdo->query($sql) as $row) {
            $cats[] = new VoteCat($row);
        }
        return $cats;
    }

    /**
     * createVoteCat
     * @param $voteCat
     * @return catid
     */
    public function createVoteCat($voteCat)
    {
        $sth = $this->pdo->prepare('insert into vote_cat( name, status, memo,seller_id, gmt_modified, gmt_create)
                           values(?,?,?,?,?,?)');
        $sth->execute(array($voteCat->name, 0, $voteCat->memo,
                           $voteCat->seller_id,date("Y-m-d H:i:s"),date("Y-m-d H:i:s")) );
        return $this->pdo->lastInsertId();
    }

    /**
     * update updateVoteCat
     * @param $voteCat
     * @return void
     */
    public function updateVoteCat($voteCat)
    {
        $sth = $this->pdo->prepare('update vote_cat set name = ?, status = ?, memo = ? WHERE id = ?');
        $sth->execute(array($voteCat->name, $voteCat->status, $voteCat->memo, $voteCat->id));
    }

    /**
     * deleteVoteCat
     * @param $id number
     * @return void
     */
    public function deleteVoteCat($id)
    {
        $this->pdo->exec('DELETE FROM vote_cat WHERE id = ' . $id);
    }
}

/**
 * @global
 */
$voteCatDAO = new VoteCatDAO();

