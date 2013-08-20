 <?
include '../../DB/db.class.php';
$smarty = new Smarty();

$db = DB::instance();
$db->setDebug();

$ret = $db->getAll('SELECT * FROM vote');

echo '<pre>';
print_r($ret);
echo '</pre>';


$wds = 'wdsdongdong';
$smarty->assign('wds', $wds);

$test = array('wds', 'name');
print_r($smarty);
print_r($test);

$smarty->display("templates/admin.tpl");
?>
