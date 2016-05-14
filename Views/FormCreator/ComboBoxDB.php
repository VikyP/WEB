<?php
require_once("FormInterfaces.php");
class ComboBoxDB  implements IControl
	{
		private	$Title, $Text, $Options, $recordIndex;
		function __construct($Title, $recordIndex )
		{
			$this->Title	= $Title;
			
			$this->recordIndex=$recordIndex;
			
			$this->Options	= array();
			$this->Options[]= "Все";
			$this->Text		= '';			
			if (isset($_REQUEST[$recordIndex]))
			{
				$this->Text = $_REQUEST[$recordIndex];
			}	
		}
		function setValue($index)
		{
			$this->Text=$this->getValueFromIndex($index);
		}
		
		function getValueFromIndex($index)
		{

			return $this->Options[$index];

		}
		
		function fillOptions($options)
		{
			foreach($options as $k=>$v)
			{
				$this->Options[$k]=$v;
			}
			
		}
		
		function GetValue()
		{			
			if($this->Text!=''&& $this->Text!="Все")
			{					
				return addslashes($this->Text);
			}
			else
				return false;
			
		}


		function __toString()
		{			
			$str = "<table width='100%'>";	
			$str .= "<tr><td>";
			$str .="<select style='width:100%;' id = '$this->recordIndex' name = '$this->recordIndex'";
			$str .='">';
			foreach($this->Options as $k=>$v)			
			{
				$str.= '<option id="'.$k."_".$this->recordIndex.'" value="'.$v.'"';
				if($this->Text==$v)
				$str.=' selected="selected" ' ;			
				$str.= ' >'.$v.'</option><br/>';
			}
			$str	.= '</select></td></tr></table>';
			return	$str;
		}
		
		function hiddenSelect()
		{	
			$str	="<div class='hidden'>".$this->Title;			
			$str	.="<select id = 'hidden_".$this->recordIndex."'>";	
			foreach($this->Options as $k=>$v)			
			{
				if($v!="Все")
				{
					$str.= '<option  name="'.$k."_".$this->recordIndex.'"  value="'.$k.'"';			
					$str.= ' >'.$v.'</option><br/>';
				}
			}
			$str	.= '</select></div>';
			return	$str;
		}
		
		function GetTitle()
		{
			return $this->Title;
			
		}
		
		function GetControlType()
		{
			return	__CLASS__;
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