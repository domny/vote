<?php
/**
 * 数据库引用与配置的绑定
 * 
 * @author Balsampear
 * @since 2013-4-14
 */
include 'database.class.php';
 
//数据库配置
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER_NAME', 'root');
define('MYSQL_USER_PASS', 'wdsdongdong');
define('MYSQL_DB_NAME', 'taobao');
define('MYSQL_PORT', 3306);


class DB {
	private static $selfRef;

	/**
	 * @return Database
	 */
	public static function instance() {
		if (! self::$selfRef) {
			self::$selfRef = new Database(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_USER_PASS, MYSQL_DB_NAME, MYSQL_PORT);
			if ($_GET['debug'] == 'lpf') {
				self::$selfRef->setDebug();
			}
		}
		return self::$selfRef;
	}
}
