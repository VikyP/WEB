<?php
	/*
	;
	; Class Date Year-Month-Day
	; ---------------------------------------------------------------
	*/
	require_once("FormInterfaces.php");
	require_once("ComboBox.php");
	
	class DateControl  implements IControl
	{
		private	$Title,  $FormName ;
		private $Year, $Month, $Day;
		
		
		function __construct($Title,  $FormName)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->Year= new ComboBox("Год ",$FormName."Year",$this->setListNum(1970,2015));
			$this->Month= new ComboBox( "Месяц",$FormName."Month", $this->setListStr(1,12));
			$this->Day= new ComboBox("День ",$FormName."Day",$this->setListNum(1,31));
			
		}
		private function setListNum($start,$end)
		{	
			$arr=array();
			for($i=$start;$i<($end+1);$i++)
			{
				$arr[$i]=$i;
			}
			return $arr;
		}
		
		private function setListStr($start,$end)
		{
			$aMonthes=array();
			$aMonthes[1] = "Январь";  
			$aMonthes[2] = "Февраль" ; 
			$aMonthes[3] = "Март"  ;
			$aMonthes[4] = "Апрель" ; 
			$aMonthes[5] = "Май"  ;
			$aMonthes[6] = "Июнь"  ;
			$aMonthes[7] = "Июль"  ;
			$aMonthes[8] = "Август" ; 
			$aMonthes[9] = "Сентябрь" ; 
			$aMonthes[10] = "Октябрь"  ;
			$aMonthes[11] = "Ноябрь"  ;
			$aMonthes[12] = "Декабрь"  ;
			return $aMonthes;
		}
		
		function __toString()
		{	
			$str	 = "<table align='center' > <tr>";
			$str	.= "<tr>";
			$str	.= "<td>".$this->Year->GetName()."</td>";
			$str	.= "<td>".$this->Month->GetName()."</td>";
			$str	.= "<td>".$this->Day->GetName()."</td>";
			$str	.= "<tr>";
			$str	.= "<td>$this->Year</td>";
			$str	.= "<td>$this->Month</td>";
			$str	.= "<td>$this->Day</td>";			
			$str	.= "</tr></table>";
			return $str;
		}
		
		// ----- Реализация интерфейса IControl -------------------------
		function GetControlType()
		{
			return	__CLASS__;
		}

		function GetValue()
		{
			$separator="-";
			return  "".$this->Year->GetValue().$separator.$this->Month->GetValue().$separator.$this->Day->GetValue();
		}

		function GetName()
		{
			return	$this->Title;
		}

		function GetVarName()
		{
			return	$this->FormName;
		}
	
	}
	
?>
