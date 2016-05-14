<?php
require_once("DB_Table.php");
require_once("./Service/loaderImage.php");


class DB_TableFilms
{
	private	 $feildIndex, $tableName, $Director, $Genre, $report;
	
	function __construct($tableName, $fIndex)
	{
		$this->feildIndex=$fIndex;
		$this->tableName=$tableName;	
	}
	
	function setCriterions($d, $g)
	{
		$this->Director=$d;
		$this->Genre=$g;
	}
		
	
	public function getReport()
	{
		return $this->report;
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
	
	
	public function selectAll()
	{
		$this->connection();
		$q="SELECT  films_06585.id_film, films_06585.name_film , directors_06585.name_director, genres_06585.name_genre,  films_06585.img_path, films_06585.id_genre, films_06585.id_director
				FROM directors_06585
						INNER JOIN (films_06585
						INNER JOIN genres_06585 ON films_06585.id_genre = genres_06585.id_genre
						) ON directors_06585.id_director = films_06585.id_director";
						
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		
		$cnt = mysql_num_rows($res);		
		for($i=0; $i<$cnt; $i++)
		{	
			$a=mysql_fetch_assoc($res);		
			$this->report[]=$a;
		}
		
		mysql_free_result($res);
		mysql_close();	
	}
	
	public function selectAllTile()
	{
		$this->connection();
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		
		$q="SELECT name_film as name, name_director as Director, name_genre as genre,  films_06585.img_path
				FROM directors_06585
						INNER JOIN (films_06585
						INNER JOIN genres_06585 ON films_06585.id_genre = genres_06585.id_genre
						) ON directors_06585.id_director = films_06585.id_director";
			
			
		$q.=$this->conditionQueryDB();// определение параметров запроса, формирование условия  where...
				
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$this->showTile($res);
	
	}
	
	public function showTile($res)
	{
		$cnt = mysql_num_rows($res);
		if($cnt==0)		
		{
			echo "<div>Ничего не найдено</div>";
			
		}
		else
		for($i=0; $i<$cnt; $i++)
		{		
			$a=mysql_fetch_assoc($res);			
			$tile= new Film($a['name'],$a['Director'],$a['genre'],$a['img_path']);
			echo "<div class='film'><h2>".$tile->getName()."</h2>";
			echo 	$tile->Poster();		
			echo "</div>";				
		}		
		
		mysql_free_result($res);
		mysql_close();
		
		
	}
	
		
	public function addRecord($rec , $id_Director, $id_genre,$img_path)
	{		
		$this->connection();		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $name_str='".addslashes($rec)."'";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt==0)		
		{
			$q="INSERT INTO $this->tableName ($name_str, id_director, id_genre ,img_path) VALUES('".addslashes($rec)."', $id_Director, $id_genre, '$img_path');";
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		@mysql_close();	
	}
	
	public function deleteRecord($id_rec)
	{
		$this->connection();		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $id_str='$id_rec'";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt!=0)		
		{
			$q="DELETE FROM $this->tableName WHERE $id_str='$id_rec';";
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	public function editRecord($id_rec, $value_rec, $id_Director, $id_genre,$img_path)
	{
		$this->connection();		
		$id_str="id_".$this->feildIndex;
		$name_str="name_".$this->feildIndex;
		$q="SELECT  $name_str  FROM $this->tableName WHERE $id_str='$id_rec'";
		$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		$cnt = mysql_num_rows($res);
		if($cnt!=0)		
		{
			$q="UPDATE $this->tableName SET $name_str= '".addslashes($value_rec)."',id_director=$id_Director, id_genre=$id_genre ,img_path='".$img_path."'  WHERE $id_str='$id_rec';";
			$res = mysql_query($q)  or die("Error SQL query [$q] (".mysql_errno().") :".mysql_error());
		}
		@mysql_free_result($res);
		mysql_close();	
	}
	
	public function actionDB()
	{
		
		$Poster= new LoadImage();
		$Poster->downloadImage();		
		/*
		echo "<pre>";
		print_r($_REQUEST);
		echo "<pre>";
		*/
		$idRecordDelete=(isset ($_REQUEST['deleteRecord']))?$_REQUEST['deleteRecord']:false;
		if($idRecordDelete!=false )
		{
			$this->deleteRecord($idRecordDelete);	
			return;
		}
		
		$id_Director=(isset ($_REQUEST['director']))?$_REQUEST['director']:1;
		$id_genre=(isset ($_REQUEST['genre']))?$_REQUEST['genre']:1;
		$img_path=(isset($_FILES['photofile']))?$_FILES['photofile']:(isset ($_REQUEST['path']))?$_REQUEST['path']:"defaultPoster.jpg";
		
		$newRecord=(isset ($_REQUEST['newRecord']))?addslashes($_REQUEST['newRecord']):false;
			
		if($newRecord)
		{
			$this->addRecord($newRecord, $id_Director, $id_genre,$img_path);			
			$_REQUEST['newRecord']=false;
			unset($_REQUEST['newRecord']);
			return;
		}
		
		$editRecord=(isset ($_REQUEST['editRecord']))?addslashes($_REQUEST['editRecord']):false;
		$idEditRecord=(isset ($_REQUEST['idRecord']))?$_REQUEST['idRecord']:false;
		if($editRecord!=false && $idEditRecord!=false)
		{
			$this->editRecord($idEditRecord, $editRecord, $id_Director, $id_genre,$img_path);
			unset($_REQUEST['editRecord']);
		}
	}
	
	public function conditionQueryDB()
	{
		$q_tmp=array();
		
		$name_Value = (isset($_REQUEST['Searchname'])&& strlen(trim($_REQUEST['Searchname']))!=0)?$_REQUEST['Searchname']:"";
		
		if($this->Director->GetValue()!=false)
			$q_tmp [] = " name_director='".$this->Director->GetValue()."'";
	
		if($this->Genre->GetValue()!=false)
			$q_tmp [] = " name_genre='".$this->Genre->GetValue()."'";	

		if($name_Value!="")		
			$q_tmp []= " name_film like '%".$name_Value."%'";

		$index=count($q_tmp);
		$where="";
		if($index!=0)
		{
			$where.=" WHERE ";
			$where.=implode(" AND ", $q_tmp);	
		}
	
		$where.=" ORDER BY name;"; 
		return $where;
	}
	
	
	
}
