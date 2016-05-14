<?php
	/*
	;
	; Class Button
	; ---------------------------------------------------------------
	*/
	require_once("FormInterfaces.php");

	class Button implements IControl
	{
		private	$Title,  $FormName, $Value;

		function __construct($Title, $FormName, $val)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->Value=$val;			
			
		}

		function __toString()
		{
			$str	= "";
			$str	.= '<input type="submit" name="'.$this->FormName.'" id = "'.$this->FormName.'" class="button button-gray" ';
			$str	.= 'value = "'.$this->Value.'" onclick="registration();" />';
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