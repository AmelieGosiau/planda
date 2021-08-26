<?php
	class db{
		private static $conn;

		public static function  getConnection(){
			include_once("./core/settings.php");

			if(self::$conn === null){
				self::$conn = new PDO("mysql:host=" .$SETTINGS['db']['host'] . ":3306;dbname=" .$SETTINGS['db']['dbName'] , $SETTINGS['db']['user'] , $SETTINGS['db']['password'] );
				return self::$conn;
			} else {
				return self::$conn;
			}
		}

	}
?>