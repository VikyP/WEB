<?php
require_once("Page.php");

require_once("./Views/Film.php");
require_once("./Views/FormCreator/MyForm.php");
require_once("./Views/FormCreator/TextBox.php");
require_once("./Views/FormCreator/ComboBoxDB.php");


require_once("./Models/DB_TableFilms.php");
require_once("./Models/DB_Table.php");

class PageMain extends Page
{
	protected function showContent()
	{
		$name_Value = (isset($_REQUEST['name'])&& strlen(trim($_REQUEST['name']))!=0)?$_REQUEST['name']:"";	
		
		$DB_Dir= new DB_Table("directors_06585", "director", "");		
		$DB_Dir->fillReport();
		$Dir = new ComboBoxDB("Режиссер", "director");
		$Dir->fillOptions($DB_Dir->getReport());
		
		$DB_Genre= new  DB_Table("genres_06585", "genre", "");
		$DB_Genre->fillReport();
		$Genre =  new ComboBoxDB("Жанр", "genre");
		$Genre ->fillOptions($DB_Genre->getReport());
		
		$Pr = new  MyForm( "" ,"Search");	
		$Pr->addCtrl($Dir);	
		$Pr->addCtrl($Genre);
		$Pr->addCtrl(new TextBox("Название", $Pr->GetVarName()."name"));

		$Pr->setAction("index.php");
		$Pr->setId("Search");
		$Pr->setButtonText("Найти");
		$Pr->setOnclick("true");	
		
		
		$Films= new DB_TableFilms("films_06585","films");
		$Films->setCriterions($Dir, $Genre);
		
		?>
	<div id="content">
		<div  class='search'><?php echo $Pr->getForm(); ?></div>	
		<div class='dataHolder' ><?php $Films->selectAllTile();?></div>
	</div>		
	
		<?php 
	}
	
}
