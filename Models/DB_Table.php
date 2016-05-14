<?php
class DB_Table
{
	private	 $feildIndex, $tableName, $errorQ="", $report;
	function __construct($tableName, $feildIndex)
	{
		$this->tableName=$tableName;
		$this->feildIndex=$feildIndex;		
		$this->report= array();
	}	
	
	public function getErrorQuery()
	{
		return $this->errorQ;		
	}
	
	public function getReport()
	{
		return $this->report;
	}
		
	
	function fillReport()
	{
		try			
		{			
		$columnName	= "name_".$this->feildIndex;
		$id_record="id_".$this->feildIndex;			
			require("connection.php");
			if(@mysql_connect($host,$user,$pswd) === false)
				 throw new  Exception("Error connect to MySQL (".mysql_errno().") :".mysql_error());
			if (mysql_select_db($dbnm)===false)
				 throw new  Exception("Error Select DB (".mysql_errno().") :".mysql_error());
			
			mysql_query("SET NAMES UTF8");				
			$q="SELECT ".$id_record.", ".$columnName. " FROM ".$this->tableName."  ORDER BY ".$columnName;
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
			
			$cnt = mysql_num_rows($res);
			for($i=0; $i<$cnt; $i++)
			{				
				$a=mysql_fetch_assoc($res);
				$value= $a[$columnName];
				$id=$a[$id_record];
				if(strlen(trim($value))!=0)					
				{
					$this->report[$id]=$value;						
				}
					
			}
			
			mysql_free_result($res);
			mysql_close();
			
		}
		catch(Exception $e)
		{
			$this->errorQ= "Error  SelectFillCB  ".$this->columnName."  ".$e->getMessage()."  ".$dbnm."<br\>"; 
		}
		
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
	
	public function addRecord($rec)
	{
		$this->connection();		
		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $name_str='".addslashes($rec)."'";
		$res = mysql_query($q)  or die("Error SQL query SELECT[$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt==0)		
		{
			$q="INSERT INTO $this->tableName ($name_str) VALUES('".addslashes($rec)."');";
			$res = mysql_query($q)  or die("Error SQL query Insert [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	
	public function deleteRecord($id_rec)
	{
		$this->connection();		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $id_str='$id_rec'";
		$res = mysql_query($q)  or  die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt!=0)		
		{
			$q="DELETE FROM $this->tableName WHERE $id_str='$id_rec';";
			$res = mysql_query($q)  or $this->errorQ="Эта запись связана с другими. <br/>Удаление невозможно";
//			die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	public function editRecord($id_rec, $value_rec)
	{
		
		$this->connection();		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $id_str='$id_rec'";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt!=0)		
		{
			$q="UPDATE $this->tableName SET $name_str= '".addslashes($value_rec)."' WHERE $id_str='$id_rec';";
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	public function actionDB()
	{
		$newRecord=(isset ($_REQUEST['newRecord']))?$_REQUEST['newRecord']:false;		
		if($newRecord)
			$this->addRecord($newRecord);	
		
		$_REQUEST['newRecord']=false;
		unset($_REQUEST['newRecord']);
		

		$idRecordDelete=(isset ($_REQUEST['deleteRecord']))?$_REQUEST['deleteRecord']:false;
		if($idRecordDelete!=false )
			$this->deleteRecord($idRecordDelete);		
		
		$editRecord=(isset ($_REQUEST['editRecord']))?$_REQUEST['editRecord']:false;
		$idEditRecord=(isset ($_REQUEST['idRecord']))?$_REQUEST['idRecord']:false;
		if($editRecord!=false && $idEditRecord!=false)
		{
			$this->editRecord($idEditRecord, $editRecord);
		}
	}
	
	
	
}