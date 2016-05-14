<?php
require_once("Page.php");
require_once("./Models/DB_TableFilms.php");
require_once("./Views/tableFilms.php");
require_once("./Views/FormCreator/ComboBoxDB.php");

class PageFilms extends Page
{
	protected function showContent()
	{		
		echo "<h1 style='text-align: center;padding-bottom:20px;'>Фильмы</h1>";	
		
		//-----Создание скрытых comboBox на страничке для работы javascript
		$DB_Director= new DB_Table("directors_06585", "director", "");		
		$DB_Director->fillReport();
		$this->Director = new ComboBoxDB("Режиссер", "director");
		$this->Director->fillOptions($DB_Director->getReport());
		
		$DB_Genre= new  DB_Table("genres_06585", "genre", "");
		$DB_Genre->fillReport();
		$this->Genre =  new ComboBoxDB("Жанр", "genre");
		$this->Genre ->fillOptions($DB_Genre->getReport());
		
		echo $this->Director->hiddenSelect();
		echo $this->Genre->hiddenSelect();
		
		
		$tabIndex="film";
		$Page="Films";
		$tabName ="films_06585";
		// Class for work with dataBase table  films_06585
		$Films= new DB_TableFilms($tabName, $tabIndex);
		$Films->actionDB();		
		$Films->selectAll();
		
		
		$Table= new TableFilms($tabIndex, $Page, $Films->getReport());		
		echo $Table;
		
	}
	
}