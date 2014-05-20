<?php
session_start();
include_once "includes/shared/ez_sql_core.php";
include_once "includes/mysql/ez_sql_mysql.php";

$ruta="/votaciones/";

Class FIMAZConfig{
	public $db_user = 'fimaz';
	public $db_password = 'be9u5etej';
	public $db_name = 'zadmin_fimaz';
	public $db_host = 'hosting.plusdrive.net';
	public $db;

	function dbConnect(){
		$this->db = new ezSQL_mysql($this->db_user, $this->db_password, $this->db_name, $this->db_host);
	} 
}