<?php
require_once("Page.php");
require_once("./Models/DB_Table.php");
require_once("./Views/tableSimple.php");
require('./Views/formMessage.php');

class PageDirectors extends Page
{
	protected function showContent()
	{
		echo "<h1 style='text-align: center;padding-bottom:20px;'>Режиссеры</h1>";
		
		$strIndex="director";
		$Page="Directors";
		$tabName ="directors_06585";
		
		$Directors= new DB_Table($tabName,$strIndex);		
		$Directors->actionDB();		
		$Directors->fillReport();		
		$Table= new TableSimple($strIndex, $Page,$Directors->getReport());
		echo $Table;		
		myAlert($Directors->getErrorQuery());	
	}
}