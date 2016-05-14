<?php
	
	require_once("FormInterfaces.php");
	require_once("TextBox.php");
	require_once("ComboBox.php");
	require_once("RadioButton.php");

	
	class MyForm  implements IControl
	{
		private	$Title, $FormName, $Ctrl, $btn, $action, $id ;
		
		function __construct($Title, $FormName, $btn,$action, $id )
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->btn=$btn;
			$this->Ctrl	= array();			
			$this->action=$action;
			$this->id=$id;			
		}
		
		public function addCtrl(IControl $c)
		{	
			$this->Ctrl[]	= $c;
		}
		
		function __toString()
		{	
			$str	= "<form action='".$this->action."' method='POST' id='Form_".$this->id."' >";
			$str	.="<input type=hidden name='action' value='".$this->FormName."'>";
			$str	.="<table  class='testForm'>";
			$str	.="<tr>";
			$str	.=	"<td>";
			$str	.=	"<h2>".$this->Title."</h2> ";
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
			$str.="</tr> 
						<tr> 
							<td align='center'>";
			$str.="<input  class='button button-gray' type='submit' value='".$this->btn."' onclick='return validationFormRegistration();' />";							
			$str.="</td>
				</tr> 
			</form>";
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

