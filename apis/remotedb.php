<?php 
/**
 * 
 */
class remoteDb
{
	public $con;
	function __construct()
	{
		$this->con = mysqli_connect("65.60.11.110", "yourchoicecharit_admin", "pa2@WORD", "yourchoicecharit_bckup") or die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}

	function query($q)
	{
		return mysqli_query($this->con, $q);

	}
}

$remoteDb = new remoteDb;

 ?>