<?php
	/*
	;
	; Class ComboBox
	; ---------------------------------------------------------------
	*/
	require_once("FormInterfaces.php");

	class ComboBox implements IControl
	{
		private	$Title, $Text, $FormName , $Options;
		function __construct($Title, $FormName, $opt)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->Options = $opt;
			$this->Text		= '';

			if (isset($_REQUEST[$this->FormName]))
			{
				$this->Text = $_REQUEST[$this->FormName];
			}
		}


		function __toString()
		{
			$str	= "";
			//$str	.= $this->Title.'&nbsp';
			$str	.= '<select name="'.$this->FormName.'" id = "'.$this->FormName.'" >';
			foreach($this->Options as $k=>$v)
			{
				if($this->Text==$k)
				$str.= '<option value="'.$k.'" selected="selected" >'.$v.'</option>' ;
				else
				$str.= '<option value="'.$k.'">'.$v.'</option><br/>';

			}
			$str	.= '</select>';
			return	$str;
		}
		
		

	// ----- Реализация интерфейса IControl -------------------------
		function GetControlType()
		{
			return	__CLASS__;
		}

		function GetValue()
		{
			return	$this->Text;
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
