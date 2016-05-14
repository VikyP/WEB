<?php
	/*
	;
	; Class Radio Button
	; ---------------------------------------------------------------
	*/
	require_once("FormInterfaces.php");

	class RadioButton implements IControl
	{
		private	$Title, $Text, $FormName, $ValuesArr;

		function __construct($Title,$FormName, $arr)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->ValuesArr=$arr;
			$this->Text		= '';

			if (isset($_REQUEST[$this->FormName]))
			{
				$this->Text = $_REQUEST[$this->FormName];
			}
		}

		function __toString()
		{
			$str	= "";
			
			foreach( $this->ValuesArr as $k=>$v)
			{
				
				$str	.= '<input type="radio" name="'.$this->FormName.'" ';
				$str	.= 'value = "'.$k.'" ';
				if($this->Text==$k)
				$str .=' checked >'.$v.'</input>';
				else
				$str .='>'.$v.'</input> &nbsp';
			}
			$str	.= '<br/>';
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
