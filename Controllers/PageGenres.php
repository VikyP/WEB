<?php
require_once("Page.php");
require_once("./Models/DB_Table.php");
require_once("./Views/tableSimple.php");
require('./Views/formMessage.php');

class PageGenres  extends Page
{
	protected function showContent()
	{
		echo "<h1 style='text-align: center;padding-bottom:20px;'>Жанры</h1>";
		$strIndex="genre";
		$tabName ="genres_06585";
		$Page="Genres";
		
		$Genres= new DB_Table($tabName,$strIndex);		
		$Genres->actionDB();		
		$Genres->fillReport();		
		$Table= new TableSimple($strIndex, $Page,$Genres->getReport());
		echo $Table;
		myAlert($Genres->getErrorQuery());	
	}	
	
}