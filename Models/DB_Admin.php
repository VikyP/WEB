<?php
class DB_Admin
{
	private	 $feildIndex="admin", $tableName="admin_films_06585", $FirstName="", $SecondName="", $errorIndex=1, $errorText="";
	
	
	public function getAdmin()
	{
	if($FirstName=="" || $SecondName=="")
		return false;
	else
		return true;
	
	}
	
	public function getErrorIndex()
	{
		return $this->errorIndex;	
	}
	public function getErrorText()
	{
		return $this->errorText;	
	}
	function connection()
	{
		require("connection.php");
		if(@mysql_connect($host,$user,$pswd) === false)
			 throw new  Exception("Error connect to MySQL (".mysql_errno().") :".mysql_error());
		if (mysql_select_db($dbnm)===false)
			 throw new  Exception("Error Select DB (".mysql_errno().") :".mysql_error());
		 
		mysql_query("SET NAMES UTF8");
		
	}
	
	public function addRecord($fname_value, $sname_value, $log_value,$pass_value )
	{
		$this->connection();
		$id_str="id_".$this->feildIndex;
		$fname=($this->feildIndex)."_firstName";
		$sname=($this->feildIndex)."_secondName";
		$log=($this->feildIndex)."_login";
		$pass=($this->feildIndex)."_password";
		$q="SELECT  $fname, $sname   FROM $this->tableName WHERE $log='$log_value' ";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt==0)		
		{
			$q="INSERT INTO $this->tableName ($fname, $sname, $log, $pass ) VALUES( '$fname_value', '$sname_value', '$log_value','$pass_value');";
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
			$this->FirstName=$fname_value;
			$this->SecondName=$sname_value;			
		}
		else
		{
			$this->errorText="Логин  $log_value  уже сущетвует .";
			$this->errorIndex=3;
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	public function checkLogin( $log_value,$pass_value)
	{
		$this->connection();
		$id_str="id_".$this->feildIndex;
		$fname=($this->feildIndex)."_firstName";
		$sname=($this->feildIndex)."_secondName";
		$log=($this->feildIndex)."_login";
		$pass=($this->feildIndex)."_password";
		$q="SELECT  $fname, $sname, $log, $pass  FROM $this->tableName WHERE $log='$log_value'";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt==1)		
		{
			$a=mysql_fetch_assoc($res);
			if($a[$pass]==$pass_value)
			{
				$this->FirstName=$a[$fname];
				$this->SecondName=$a[$sname];
			}
			else
			{
				$this->errorIndex=2;
				$this->errorText="Логин или пароль указаны неверно.";
			}
		}
		else
		{
			if($cnt==0)
			{
				$this->errorText="Логин  $log_value  не найден. Зарегистрируйтесь.";
				$this->errorIndex=2;
			}
			else
			{
				$this->errorText="************.";
				$this->errorIndex=4;
			}
		}
		
		@mysql_free_result($res);
		mysql_close();	
		
	}
	
	
	
	
	
	
	
}