<?php
	/*
	;
	; Class TextBox
	; ---------------------------------------------------------------
	*/
	require_once("FormInterfaces.php");

	class TextBox implements IControl
	{
		private	$Title, $Text, $FormName;

		function __construct($Title, $FormName)
		{
			$this->Title	= $Title;
			$this->FormName	= $FormName;
			$this->Text		= '';
			if (isset($_REQUEST[$this->FormName]))
			{
				$this->Text = trim($_REQUEST[$this->FormName]);
			}
		}

		function __toString()
		{
			$key="Пароль";
			$str	= "";
			$str	.= '<input ';			
			if( strcmp($this->Title,$key)==0)
			{
				$str	.= ' type="password"';
			}
			else
			{
				$str	.= ' type="text"';	
			}
			
			$str	.' name="'.$this->FormName.'" id = "'.$this->FormName.'" ';
			$str	.= 'value = "" />';
			return	$str;
		}

	// ----- –еализаци¤ интерфейса IControl -------------------------
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