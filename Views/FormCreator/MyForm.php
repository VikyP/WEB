<?php
	
	require_once("FormInterfaces.php");
	require_once("TextBox.php");
	require_once("ComboBox.php");
	require_once("RadioButton.php");

	
	class MyForm  implements IControl
	{
		private	$Title, $FormName, $Ctrl, $btn, $action, $id, $onclickF, $classTable;
		
		function __construct($Title, $FormName)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;			
			$this->Ctrl	= array();
						
		}
		
		
		public function setAction($action)
		{
			$this->action=$action;
		}
		public function setId($id)
		{
			$this->id=$id;
		}
		
		public function setButtonText($btn)
		{
			$this->btn=$btn;
		}
		
		public function setOnclick($funcName)
		{
			$this->onclickF=$funcName;
		}
		public function addCtrl(IControl $c)
		{	
			$this->Ctrl[]	= $c;
		}
		
		public function setTableClass($class)
		{
			$this->classTable=$class;
		}
		function __toString()
		{	
		
			$str	= "<form action='".$this->action."' method='POST' id='Form_".$this->id."' name='Form_".$this->FormName."'>";
			$str	.="<input type='hidden' name='action' value='".$this->FormName."'/>";
			$str	.="<table class='".$this->classTable."' >";//
			$str	.="<tr>";
			$str	.=	"<td>";
			$str	.=	"<h2>".$this->Title."</h2></td></tr>";
			$str	.=	"<tr>";
			$str	.=	"<td>";
			$str	.=  "<table align='center' width='90%' >";	
				
				foreach($this->Ctrl as $C)
				{	
					$str.='<tr><td  align="left">'.$C->GetName().'</td> <td  align="left">'.$C.'</td>';
					$t="error_".$C->GetVarName();
					$str.='<td align="left" id="'.$t.'" ></td>';				
					$str.='</tr>';
				}
					
				$str.="</table>";
			$str.="</td>";
			$str.="</tr>";
			$str.="<tr> ";
				$str.="	<td align='center'>";
			$str.="<input id='".$this->FormName."_submit'  class='button button-gray' type='submit' value='".$this->btn."' onclick='return ".$this->onclickF." ;' />";							
			$str.="</td></tr>";
				 
			$str.="</table>";
			$str.="</form>";
			return $str;
		}
		
		
		function getForm()
		{	
		
			$str	= "<form action='".$this->action."' method='POST' id='Form_".$this->id."' name='Form_".$this->FormName."'>";
			$str	.="<input type='hidden' name='action' value='".$this->FormName."'/>";
			$str	.="<table class='".$this->classTable."' >";//
			$str	.="<tr>";
			$str	.=	"<td>";
			$str	.=	"<h2>".$this->Title."</h2></td></tr>";
			$str	.=	"<tr>";
			$str	.=	"<td>";
			$str	.=  "<table align='center' width='90%' >";	
				
				foreach($this->Ctrl as $C)
				{	
					$str.="<tr>";
					$str.="<tr><td><h3 align='left'>".$C->GetName()."</h3></td></tr>";
					$str.="<tr><td  align='left'>".$C."</td></tr>";					
				}
					
				$str.="</table>";
			$str.="</td>";
			$str.="</tr>";
			$str.="<tr> ";
				$str.="	<td align='center'>";
			$str.="<input class='button button-gray' type='submit' value='".$this->btn."'  id='".$this->FormName."_submit'   onclick='return ".$this->onclickF." ;' />";							
			$str.="</td></tr>";
				 
			$str.="</table>";
			$str.="</form>";
			return $str;
		}
		// ----- Реализация интерфейса IControl -------------------------
		function GetControlType()
		{
			return	__CLASS__;
		}
		
		function GetInfo()
		{
			
			$str="";
			foreach($this->Ctrl as $C)
			{
				$str.= $C->GetVarName()."=".$C->GetValue()."&";				
			}
			
			return $str;
		}

		function GetValue()
		{
			foreach($this->Ctrl as $C)
			{
				echo'<tr><td width="50%" align="right">'.$C->GetName().'&nbsp;</td>';
				echo'<td width="50%" align="left">'.$C->GetValue().'</td></tr>';
				
			}
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

