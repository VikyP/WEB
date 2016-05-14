<?php 
require_once("../Models/DB_Admin.php");
$action=(isset($_POST['action']))?$_POST['action']:false;

$CheckLogin= new DB_Admin();

switch($action)
{
	case "Autorization":
	$Login = (isset($_POST['AutorizationLogin'])&& strlen(trim($_POST['AutorizationLogin']))!=0)?$_POST['AutorizationLogin']:false;
	$Password = (isset($_POST['AutorizationPassword'])&& strlen(trim($_POST['AutorizationPassword']))!=0)?$_POST['AutorizationPassword']:false;
	$CheckLogin->checkLogin( $Login,$Password);	
	break;
	
	case "Registration":	
	$SurName = (isset($_POST['RegistrationSurName']) && strlen(trim($_POST['RegistrationSurName']))!=0)?$_POST['RegistrationSurName']:false;
	$Name = (isset($_POST['RegistrationName'])&& strlen(trim($_POST['RegistrationName']))!=0)?$_POST['RegistrationName']:false;
	$Login = (isset($_POST['RegistrationLogin'])&& strlen(trim($_POST['RegistrationLogin']))!=0)?$_POST['RegistrationLogin']:false;
	$Password = (isset($_POST['RegistrationPassword'])&& strlen(trim($_POST['RegistrationPassword']))!=0)?$_POST['RegistrationPassword']:false;
	
	$CheckLogin->addRecord($Name, $SurName, $Login,$Password);
	break;
	
	default:
	header("Location:../index.php?id=Main");
	exit;
	
	
}


session_start();

$_SESSION['autorization'] = $CheckLogin->getErrorIndex();
$id="";
switch($CheckLogin->getErrorIndex())
{
	case 1:
		$id="Main";
		break;
	case 2:
		$id="Login";
		$_SESSION['autorizationError'] =$CheckLogin->getErrorText();
		break;
	case 3:
		$id="Registration";
		$_SESSION['autorizationError'] =$CheckLogin->getErrorText();
		break;		
}

header("Location:../index.php?id=$id");
exit();
?>