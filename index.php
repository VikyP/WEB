<?php
session_start();
require_once("menu.php");
require_once("Autorization.php");

$autorization=(isset($_SESSION['autorization']))?$_SESSION['autorization']:"Null";
//---- Page id
$id=(isset ($_REQUEST['id']))?$_REQUEST['id']:"Main";

//--- Menu ---
$menu=new Menu();
$btnLogin="";
//--- 
switch($autorization)
{
	case 1:
		$btnLogin ="Выход";
		$menu->addItem("Main", "Главная");	
		$menu->addItem("Directors", "Режиссеры ");
		$menu->addItem("Genres", "Жанры");
		$menu->addItem("Films", "Фильмы");	
	break;
	
	case "Null":		
		if($id!="Login"&& $id!="Registration")
		{
			$id="Main";
			$btnLogin ="Вход";
		}
		else
		{
			$menu->addItem("Main", "Главная");			
		}
	break;	
	case 2: case 3:
		$menu->addItem("Main", "Главная");
	break;
	
}

$admin= new Autorization();
$admin->setLabel($btnLogin) ;

//--- Page ---
require_once("./Controllers/Page$id.php");
$pageClass ="Page".$id;
$page = new $pageClass($menu, $admin);
$page->showPage();