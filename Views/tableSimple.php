<?php
class TableSimple 
{
	private	 $rowValues, $recordIndex, $Page;
	function __construct($recordIndex, $pageIndex, $report  )
	{
		$this->Page=$pageIndex;
		$this->rowValues=array();
		$this->rowValues=$report;
	}
	
	
	function __toString()
	{		
		$Str=	"<table  class='table' id='$this->Page'>";
		$Str.=	"<tr class='line' >";
		$Str.=	"<td  style='text-align: left;'>";
		$Str.=	"<img class='buttonT' src='./Site_Images/add.png' title='Добавить' onclick='AddRecord(\"$this->Page\"); return false;'/>";
		$Str.=	"";
		$Str.=	"</td>";			
		$Str.=	"</tr>"	;
		$i=1;
		foreach($this->rowValues as $k=>$v)
		{
					
			$Str.=	 "<tr class='line' ><td>".($i)."</td><td>".$v."</td>";			
			$Str.=	 "<td style='text-align: center;'>";			
			$Str.=	 "<img class='buttonT' src='./Site_Images/write_48.png' title='Редактировать' onclick='EditRecord( \"$this->Page\" , $k, \"$v\"); return false;'/> ";					
			$Str.=	 "</td>";
			$Str.=	 "<td>";
			$Str.=	 "<img class='buttonT' src='./Site_Images/remove.png' title='Удалить' onclick='DeleteRecord( \"$this->Page\", $k, \"$v\"); return false;' />	";
			$Str.=	 "</td>";			
			$Str.=	 "</tr>";				
			$i++;
		}
		
		$Str.=	 "</table>";		
		return $Str;
	}
}
