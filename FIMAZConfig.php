<?php
session_start();
include_once "includes/shared/ez_sql_core.php";
include_once "includes/mysql/ez_sql_mysql.php";
Class FIMAZConfig{
	public $db_user = 'root';
	public $db_password = '';
	public $db_name = 'fimaz';
	public $db_host = 'localhost';
	public $db;

	function dbConnect(){
		$this->db = new ezSQL_mysql($this->db_user, $this->db_password, $this->db_name, $this->db_host);
	} 
}