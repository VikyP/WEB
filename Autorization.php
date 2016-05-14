<?php

class Autorization 
{
	private $btnLabel="";
	
	public function setLabel($str)
	{
		$this->btnLabel=$str;
	}
	public function showIcon()
	{	
		if($this->btnLabel=="")
			return "";
		
	    $key="Выход";
		$S="<div  id='logButton'>";
		if(strcmp($this->btnLabel,$key)==0)
			$S .= "<a href='./Service/exit.php'><image src='./Site_Images/Login-out-icon.png'  title= '".$this->btnLabel."' /></a></div>";
		else
			$S .= "<a href='./index.php?id=Login'><image src='./Site_Images/Login-in-icon.png' title= '".$this->btnLabel."'/></a></div>";
		
		return  $S;
	}
	
}


