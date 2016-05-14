<?php
header('Content-type: text/html; charset=utf-8');
require_once("./menu.php");
require_once("./Autorization.php");

class Page
{
	private $menu, $login ;
	function __construct( Menu $M, Autorization $L)
	{
		$this->menu= $M;
		$this->login= $L;		
	}
	
	private function BeginPage()
	{		
		echo "<!DOCTYPE html>";
		echo "<html>";
		echo "<head  lang='ru-RU'>";
		echo "<meta charset='utf-8'/>";
		echo "<script type='text/javascript' src='./Script/scripts.js'></script>";
		echo "<script type='text/javascript' src='./Script/scriptsFilms.js'></script>";
		echo "<link rel='stylesheet' type='text/css' href='./CSS/style.css' > ";
		echo "<link rel='stylesheet' type='text/css' href='./CSS/styleTable.css' > ";
		echo "<link rel='stylesheet' type='text/css' href='./CSS/demo-page.css' > ";
		echo "<link rel='stylesheet' type='text/css' href='./CSS/style-modal.css' > ";		
		echo "</head>";
		if(isset($_SESSION['autorizationError']))
		{
			$message=$_SESSION['autorizationError'];
			echo "<body onload ='autorizationError(".'" '.$message.' "'.")'>";			
			unset($_SESSION['autorization']);
			unset($_SESSION['autorizationError']);
		}
		else
			echo "<body>";
		
		
	}
	
	private function endPage()
	{
		echo "</body>";
		echo "</html>";
	}
	
	
	private function showHeader()
	{
		echo "<div id='header' >";
		echo "<h1 style='text-align: center'>Популярные фильмы</h1>";
		echo "</div>";
	}
	private function showMenu()
	{
		echo $this->menu->showMenu();
	}
	
	private function showIconIn_Out()
	{
		echo $this->login->showIcon();
	}
	
	
	private function showFooter()
	{
		
	}
	protected function showContent()
	{
		echo "<h1 style='color: red; text-align:center'> Not Found</h1>";
		
	}
	public function showPage()
	{
		$this->BeginPage();
		$this->showHeader();
		$this->showIconIn_Out();
		$this->showMenu();
		$this->showContent();	
		$this->endPage();
	}
	
}