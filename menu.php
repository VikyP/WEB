<?php
class Menu
{
	private $items=array();
	public function addItem($id,$name)
	{
		$this->items[$id]	=$name;		
	}
	
	public function showMenu()
	{
		$S="<div id='menu'>";
		$S .="<table  width ='100%' align='center' >";
		$S .="<tr>";
		foreach($this->items as $k=>$v)
		{
			$S	.="<td align ='center' >";
			$S	.="<a href='./index.php?id=$k'>$v</a>";
			$S  .= "</td>";
			
		}
		$S .= "</tr>";
		$S .= "</table>";
		$S .="</div>";
		return $S;
	}
	
}

