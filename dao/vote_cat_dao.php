<?php
require_once("dbconfig.php");




/**
 * ͶƱ��Ŀ�ķ���
 * @author shihong
 */
class VoteCat extends BaseDO
{
    /**
     * ͶƱ��Ŀ��������
     * @var name
     */
    public $name;

    /**
     * ͶƱ��Ŀ����id
     * @var id
     */
    public $id;

   /**
     *״̬������0������-1��
     * @var status
     */
    public $status;

    /**
     * ��ע��Ϣ
     * @var memo
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
 * ͶƱ��Ŀ�������ݷ��ʲ�
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
   * ����id��ѯͶƱ����
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
     * �������Ҳ�ѯͶƱ����
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

